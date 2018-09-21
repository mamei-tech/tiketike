<?php

use Illuminate\Database\Seeder;

class ConfigsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Raffle Config Seeder

        DB::table('configraffles')->insert([                    // GW FEE
            'name' => 'gwfee',
            'value' => 10,
            'default' => 10,
            'description' => 'This is a % value with the purpose of save money in the trasaction ops out of the tiketike account. If a pay gateway owner charche a 10% for transaction, 10 is the value that could be use in this conf field.5 is the default value.',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('configraffles')->insert([                    // Min value for withdraw
            'name' => 'minextractbalance',
            'value' => 50,
            'default' => 50,
            'description' => 'Minimun valuer for make a withdrow of a user balance.',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
