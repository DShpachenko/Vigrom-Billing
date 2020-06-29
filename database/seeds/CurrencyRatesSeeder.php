<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CurrencyRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $time = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('wallets')->insert([
            'id' => 241,
            'balance' => 0.0,
            'currency' => 'USD',
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        DB::table('wallets')->insert([
            'id' => 242,
            'balance' => 0.0,
            'currency' => 'RUB',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }
}
