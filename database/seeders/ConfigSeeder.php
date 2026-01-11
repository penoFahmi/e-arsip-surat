<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Config::insert([
            [
                'code' => 'default_password',
                'value' => 'password',
            ],
            [
                'code' => 'page_size',
                'value' => '5',
            ],
            [
                'code' => 'app_name',
                'value' => 'Aplikasi Surat Menyurat',
            ],
            [
                'code' => 'institution_name',
                'value' => '+62',
            ],
            [
                'code' => 'institution_address',
                'value' => 'Jl. Mana Saja',
            ],
            [
                'code' => 'institution_phone',
                'value' => '082121212121',
            ],
            [
                'code' => 'institution_email',
                'value' => 'admin@admin.com',
            ],
            [
                'code' => 'language',
                'value' => 'id',
            ],
            [
                'code' => 'pic',
                'value' => 'Sarjana Kopi',
            ],
            [
                'code' => 'name_of_the_head_of_the_institution',
                'value' => 'Prof. Peno',
            ],
            [
                'code' => 'nip_of_the_head_of_the_institution',
                'value' => '1x1x1x1x1',
            ],
        ]);
    }
}
