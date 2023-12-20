<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // data
        $data = [
            ['name' => 'Category 1', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Category 2', 'created_at' => date('Y-m-d H:i:s')],
            ['name' => 'Category 3', 'created_at' => date('Y-m-d H:i:s')],
        ];

        // Using Query Builder
        $this->db->table('categories')->insertBatch($data);
    }
}
