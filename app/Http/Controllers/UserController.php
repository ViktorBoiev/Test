<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showPreferences()
    {
        $user = \Auth::user()->load('preferences');
        if (!$user->preferences) {
            $user->preferences()->create([]);
            $user->load('preferences');   //reloading preferences
        }
        return view('user.preferences', compact('user'));
    }

    public function updatePreferences(Request $request)
    {
        $user = \Auth::user()->load('preferences');
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'required|string|min:3|max:70',
            'delivery_country' => 'string|nullable',
            'delivery_city' => 'string|nullable',
            'delivery_state' => 'string|nullable',
            'delivery_zip' => 'integer|nullable',
            'delivery_street' => 'string|nullable',
            'delivery_building' => 'string|nullable',
            'delivery_apartment' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput();
        }
        $dataUser = $request->only(['email', 'name']);
        $dataPreferences = $request->only([
            'delivery_country',
            'delivery_city',
            'delivery_state',
            'delivery_zip',
            'delivery_street',
            'delivery_building',
            'delivery_apartment',
        ]);

        $user->update($dataUser);
        $user->preferences->update($dataPreferences);
        return redirect()
            ->back()
            ->with('status', 'Success!');
    }
}
