<?php

namespace App\Console\Commands;

use App\Helpers\PaypalHelper;
use App\Models\WinnerLog;
use Illuminate\Console\Command;

class SendMoneyToFailed extends Command
{
    use PaypalHelper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'money:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send money to users that win a prize';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $moneyWins = WinnerLog::whereIn('status', [WinnerLog::STATUS_ERROR, WinnerLog::STATUS_PENDING])
            ->where('win_type', WinnerLog::TYPE_MONEY)
            ->with('winner')
            ->limit(env('SEND_MONEY_CONSOLE_LIMIT', 10))
            ->get();
        foreach($moneyWins as $win) {
            $data = $this->makePay($win->winner->email, $win->quantity);
            $win->status = WinnerLog::STATUS_ACCEPTED;
            if (isset($data['err'])) {
                \Log::critical($data['err']);
                $win->status = WinnerLog::STATUS_ERROR;
            }
            $win->save();
        }
    }
}
