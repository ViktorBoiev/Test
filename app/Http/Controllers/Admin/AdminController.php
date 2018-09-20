<?php

namespace App\Http\Controllers\Admin;

use App\Models\BaseConfig;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

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
        return Datatables::of(User::query())
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
