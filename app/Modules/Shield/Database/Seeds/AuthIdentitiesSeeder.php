<?php

namespace App\Modules\Shield\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthIdentitiesSeeder extends Seeder
{
    public function run()
    {
        // data
        $data = [
            ['user_id' => 1, 'type' => 'email_password', 'name' => null, 'secret' => 'superadmin@email.com', 'secret2' => password_hash('p@$$w0rd!', PASSWORD_DEFAULT), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];

        // Using Query Builder
        $this->db->table('auth_identities')->insertBatch($data);
    }
}
