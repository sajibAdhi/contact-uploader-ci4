<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'email'    => 'test@example.com',
        ];

        $this->db->table('users')->insert($data);
    }
}
