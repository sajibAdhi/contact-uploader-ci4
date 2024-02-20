<?php

namespace App\Database\Seeds;

use App\Modules\OperatorBill\Database\Seeds\OperatorSeeder;
use CodeIgniter\Database\Seeder;

class AllSeeder extends Seeder
{
    public function run()
    {
         $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(OperatorSeeder::class);
    }
}
