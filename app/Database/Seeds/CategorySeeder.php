<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // data
        $data = [
            ['name' => 'Local'],
            ['name' => 'Govt'],
            ['name' => 'VIP'],
            ['name' => 'Commercial'],
        ];

        // Using Query Builder
        $this->db->table('categories')->insertBatch($data);
    }
}
