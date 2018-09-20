<?php

namespace App\Http\Controllers;

use App\Helpers\StripeHelper;
use App\Models\BaseConfig;
use App\Models\Gift;
use App\Models\WinnerLog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use StripeHelper;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function lottery()
    {
        return view('lottery');
    }

    public function prize()
    {
        $user = \Auth::user();

        $prizes = [
            WinnerLog::TYPE_GIFT,
            WinnerLog::TYPE_LOYALTY,
        ];

        $totalWins = WinnerLog::where('win_type',WinnerLog::TYPE_MONEY)
            ->whereIn('status', [WinnerLog::STATUS_PENDING, WinnerLog::STATUS_ACCEPTED])  //where user accepted or not choose yet
            ->sum('win_quantity');

        //defining if there is a chance to win money
        if ($totalWins < BaseConfig::where('key', BaseConfig::MONEY_WIN_LIMIT)->first()->value) {
            $prizes[] = WinnerLog::TYPE_MONEY;
        }

        $prize = array_rand($prizes);
        $prize = $prizes[$prize];

        $quantity = 1;

        switch ($prize) {
            case WinnerLog::TYPE_LOYALTY:
                $quantity = rand(BaseConfig::where('key',BaseConfig::MIN_LOYALTY_WIN)->first()->value,
                    BaseConfig::where('key',BaseConfig::MAX_LOYALTY_WIN)->first()->value);
                break;

            case WinnerLog::TYPE_MONEY:
                $quantity = rand(BaseConfig::where('key',BaseConfig::MIN_MONEY_WIN)->first()->value,
                    BaseConfig::where('key', BaseConfig::MAX_MONEY_WIN)->first()->value);
                break;

            case WinnerLog::TYPE_GIFT:
                $giftType = $this->generateGift();
                break;
        }

        $data = [
            'winner_id' => $user->id,
            'win_type' => $prize,
            'win_quantity' => $quantity,
            'status' => WinnerLog::STATUS_PENDING
        ];

        if (isset($giftType)) {
            $data['gift_type'] = $giftType;
        }

        $log = WinnerLog::create($data);

        unset($data['winner_id']);
        unset($data['status']);
        $data['id'] = $log->id;

        return response()->json($data, 200);
    }

    public function declinePrize(Request $request)
    {
        $prize = WinnerLog::findOrFail($request->get('id'));
        $user = \Auth::user();

        if ($prize->winner_id != $user->id) {
            return response()->json(['status' => 'Wrong request'], 400);
        }

        if ($prize->gift_type) {
            $gift = Gift::where('name', $prize->gift_type)->first();

            $gift->quantity ++;
            $gift->save();
        }

        $prize->status = WinnesrLog::STATUS_DECLINED;
        $prize->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function convertPrize(Request $request)
    {
        $prize = WinnerLog::findOrFail($request->get('id'));
        $user = \Auth::user();

        if ($prize->winner_id != $user->id) {
            return response()->json(['status' => 'Wrong request'], 400);
        }

        if ($prize->win_type !== WinnerLog::TYPE_MONEY) {
            return response()->json(['status' => 'Wrong prize type'], 400);
        }
        $prize->status = WinnerLog::STATUS_CONVERTED_TO_LOYALTY;
        $prize->save();

        $user->loyalty_points += $prize->win_quantity * +BaseConfig::where('key', BaseConfig::CONVERSION_RATIO)->first()->value;
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function acceptPrize(Request $request)
    {
        $prize = WinnerLog::findOrFail($request->get('id'));
        $user = \Auth::user();

        if ($prize->winner_id != $user->id) {
            return response()->json(['status' => 'Wrong request'], 400);
        }

        switch ($prize->win_type) {
            case WinnerLog::TYPE_LOYALTY:
                $user->loyalty_points += $prize->win_quantity;
                $user->save();
                $prize->status = WinnerLog::STATUS_ACCEPTED;
                break;

            case WinnerLog::TYPE_MONEY:
                $pay = $this->makePay($user->email, $prize->win_quantity);
                if (!isset($pay['err'])) {
                    $prize->status = WinnerLog::STATUS_ACCEPTED;
                } else {
                    $prize->status = WinnerLog::STATUS_ERROR;
                    \Log::critical($pay['err']);
                }
                break;

            case WinnerLog::TYPE_GIFT:
                $prize->status = WinnerLog::STATUS_ACCEPTED;
                $message = 'Be sure you have correct data in preferences to receive your prize!';
                break;
        }
        $prize->save();

        $response = [
            'status' => 'success'
        ];
        if (isset($message)) {
            $response['message'] = $message;
        }

        return response()->json($response, 200);
    }

    protected function generateGift()
    {
        $gift = Gift::where('quantity', '>', 0)->inRandomOrder()->first();
        $giftType = $gift->name;

        $gift->quantity --;
        $gift->save();

        return $giftType;
    }

}
