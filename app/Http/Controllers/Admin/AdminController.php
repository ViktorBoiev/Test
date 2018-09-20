<?php

namespace App\Http\Controllers\Admin;

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

    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getUsers()
    {
        return view('admin.users.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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
}
