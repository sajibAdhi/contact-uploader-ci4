<?php

namespace App\Modules\Shield\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // data
        $data = [
            [
                'username' => 'admin',
                'active' => 0,
            ],
        ];

        // Using Query Builder
        $this->db->table('auth_identities')->insertBatch($data);
    }
}
