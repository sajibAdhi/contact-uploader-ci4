<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Modules\OperatorBill\Database\Seeds\OperatorSeeder;

class AllSeeder extends Seeder
{
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(OperatorSeeder::class);
    }
}
