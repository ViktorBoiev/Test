<?php

use Illuminate\Database\Seeder;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('qweqwe')
        ]);
        $user->save();
    }
}
