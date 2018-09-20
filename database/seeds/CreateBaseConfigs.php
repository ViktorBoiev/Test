<?php

use Illuminate\Database\Seeder;

class CreateBaseConfigs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\BaseConfig::create([
            'key' => \App\Models\BaseConfig::MIN_LOYALTY_WIN,
            'value' => 100
        ]);
        \App\Models\BaseConfig::create([
            'key' => \App\Models\BaseConfig::MAX_LOYALTY_WIN,
            'value' => 300
        ]);

        \App\Models\BaseConfig::create([
            'key' => \App\Models\BaseConfig::MIN_MONEY_WIN,
            'value' => 1
        ]);

        \App\Models\BaseConfig::create([
            'key' => \App\Models\BaseConfig::MAX_MONEY_WIN,
            'value' => 100
        ]);

        \App\Models\BaseConfig::create([
            'key' => \App\Models\BaseConfig::MONEY_WIN_LIMIT,
            'value' => 10000
        ]);

        \App\Models\BaseConfig::create([
            'key' => \App\Models\BaseConfig::CONVERSION_RATIO,
            'value' => 1.5
        ]);
    }
}
