<?php

use Illuminate\Database\Seeder;

class CreateBaseGifts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            \App\Models\Gift::create([
                'name' => 'Item'.$i,
                'quantity' => rand(1,10)
            ]);
        }
    }
}
