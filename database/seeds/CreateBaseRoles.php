<?php

use Illuminate\Database\Seeder;

class CreateBaseRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Models\Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Administrator';
        $admin->description  = 'User is allowed to proceed admin panel';
        $admin->save();

        $user = \App\User::find(1);
        $user->attachRole($admin);
    }
}
