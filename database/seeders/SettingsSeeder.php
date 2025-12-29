<?php

namespace Database\Seeders;

use App\Models\Admin\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Setting::create(
            [
                'key' => 'auto_update_time',
                'value' => true,
                'type' => 'boolean',
                'description' => 'Auto Update Time of Player In All Tournaments'
            ]
        );
    }
}
