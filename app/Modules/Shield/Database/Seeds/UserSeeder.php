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
                'username' => 'superadmin',
                'active' => 1,
            ],
        ];

        // Using Query Builder
        $this->db->table('auth_identities')->insertBatch($data);
    }
}
