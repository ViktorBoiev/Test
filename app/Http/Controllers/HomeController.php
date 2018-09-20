<?php

namespace App\Http\Controllers;

use App\Models\BaseConfig;
use App\Models\Gift;
use App\Models\WinnerLog;
use Illuminate\Http\Request;

class HomeController extends Controller
{

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
            ->whereIn('win_status', [WinnerLog::STATUS_PENDING, WinnerLog::STATUS_ACCEPTED])  //where user accepted or not choose yet
            ->sum('win_quantity');

        //defining if there is a chance to win money
        if ($totalWins < BaseConfig::MONEY_WIN_LIMIT) {
            $prizes[] = WinnerLog::TYPE_MONEY;
        }

        $prize = array_rand($prizes);

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
            'quantity' => $quantity,
            'status' => WinnerLog::STATUS_PENDING
        ];

        if (isset($giftType)) {
            $data['gift_type'] = $giftType;
        }

        WinnerLog::create($data);

        unset($data['winner_id']);
        unset($data['status']);

        return response()->json($data, 200);
    }

    public function declinePrize(Request $request)
    {
        $prize = WinnerLog::findOrFail($request->get('id'));
        $user = \Auth::user();

        if ($prize->winner_id != $user->id) {
            return response()->json(['status' => 'Wrong request'], 400);
        }

        $prize->status = WinnerLog::STATUS_DECLINED;
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

    protected function generateGift()
    {
        $gift = Gift::where('quantity', '>', 0)->inRandomOrder()->first();
        $giftType = $gift->name;

        $gift->quantity --;
        $gift->save();

        return $giftType;
    }
}
