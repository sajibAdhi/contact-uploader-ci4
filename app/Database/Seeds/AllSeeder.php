<?php

namespace App\Database\Seeds;

use App\Modules\OperatorBill\Database\Seeds\OperatorSeeder;
use App\Modules\Shield\Database\Seeds\UserSeeder;
use CodeIgniter\Database\Seeder;

class AllSeeder extends Seeder
{
    public function run()
    {
//         $this->call(UserSeeder::class);
        $this->call(OperatorSeeder::class);
    }
}
