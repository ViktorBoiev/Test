<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseConfig;
use App\Models\Gift;
use App\Models\WinnerLog;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getUsers()
    {
        return view('admin.users.index');
    }

    public function usersData()
    {
        return \DataTables::of(User::query())
            ->addColumn('action', function ($user) {
                return '<a href="'.route('admin.users.show', $user->id).'" class="btn btn-info">Details</a>';
            })
            ->make(true);
    }

    public function showUser($id)
    {
        $user = User::with('preferences')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function getLogs()
    {

        return view('admin.logs.index');
    }

    public function logsData()
    {
        $logs = WinnerLog::select([
            'winner_logs.*',
            \DB::raw('users.name as winner_name' )
        ])
            ->leftJoin('users', 'winner_logs.winner_id', '=', 'users.id')
            ->get();

        return \DataTables::collection($logs)
            ->addColumn('action', function ($log) {
                return '<a href="'.route('admin.logs.show', $log->id).'" class="btn btn-info">Details</a>';
            })
            ->editColumn('status', function ($log) {
                return WinnerLog::ARRAY_OF_STATUSES[$log->status];
            })
            ->make(true);
    }

    public function showLog($id)
    {
        $log = WinnerLog::with('winner')->findOrFail($id);
        return view('admin.logs.show', compact('log'));
    }

    public function updateLog(Request $request, $id)
    {
        $log = WinnerLog::findOrFail($id);
        $log->status = $request->get('status');
        $log->save();

        return redirect()
            ->back()
            ->with('status', 'Success!');
    }

    public function getGifts()
    {
        return view('admin.gifts.index');
    }
    public function createGift()
    {
        return view('admin.gifts.create');
    }

    public function giftsData()
    {
        return \DataTables::of(Gift::query())
            ->addColumn('action', function ($gift) {
                return '<a href="'.route('admin.gifts.show', $gift->id).'" class="btn btn-info">Details</a>';
            })
            ->make(true);
    }

    public function showGift($id)
    {
        $gift = Gift::findOrFail($id);
        return view('admin.gifts.show', compact('gift'));
    }

    public function storeGift(Request $request, $id = null)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'quantity' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        if ($id) {
            $gift = Gift::findOrFail($id);
        } else {
            $gift = new Gift();
        }

        $gift->name = $request->get('name');
        $gift->quantity = $request->get('quantity');
        $gift->save();

        return redirect()
            ->back()
            ->with('status', 'Success!');
    }

    public function showConfigs()
    {
        $configs = BaseConfig::all();
        return view('admin.configs', compact('configs'));
    }

    public function updateConfigs(Request $request)
    {

        $data = $request->except(['_token', '_method']);
        $validator = \Validator::make($request->all(), [
            str_replace( ' ', '_', BaseConfig::MIN_LOYALTY_WIN) => 'required|integer|min:1',
            str_replace( ' ', '_', BaseConfig::MAX_LOYALTY_WIN) => 'required|integer|gt:' . str_replace( ' ', '_', BaseConfig::MIN_LOYALTY_WIN),
            str_replace( ' ', '_', BaseConfig::MIN_MONEY_WIN) => 'required|integer|min:1',
            str_replace( ' ', '_', BaseConfig::MAX_MONEY_WIN) => 'required|integer|gt:' . str_replace( ' ', '_', BaseConfig::MIN_MONEY_WIN),
            str_replace( ' ', '_', BaseConfig::MONEY_WIN_LIMIT) => 'required|integer|gt:' . str_replace( ' ', '_', BaseConfig::MAX_MONEY_WIN),
            str_replace( ' ', '_', BaseConfig::CONVERSION_RATIO) => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $configs = BaseConfig::all();

        foreach ($data as $k => $v) {
            $config = $configs->where('key', str_replace( '_', ' ', $k))->first();
            $config->value = $v;
            $config->save();
        }

        return redirect()
            ->back()
            ->with('status', 'Success!');
    }
}
