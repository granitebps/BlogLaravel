<?php

use Illuminate\Database\Seeder;
use App\Models\SettingModel;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingModel::create([
            'site_name' => 'MyMind',
            'about' => 'Blog'
        ]);
    }
}
