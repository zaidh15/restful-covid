<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::create([
            'name'        => 'John Doe',
            'phone'       => '12345',
            'address'     => 'Mars',
            'status'      => 'Positive',
            'in_date_at'  => date('YmdHis')
        ]);

        Patient::create([
            'name'        => 'Chris Pitt',
            'phone'       => '123456',
            'address'     => 'Jupiter',
            'status'      => 'Recovered',
            'in_date_at'  => date('YmdHis'),
            'out_date_at' => date('YmdHis')
        ]);

        Patient::create([
            'name'        => 'XAE-17',
            'phone'       => '1234567',
            'address'     => 'Pluto',
            'status'      => 'Dead',
            'in_date_at'  => date('YmdHis'),
            'out_date_at' => date('YmdHis')
        ]);
    }
}
