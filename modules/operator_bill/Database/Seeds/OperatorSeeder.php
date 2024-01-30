<?php

namespace Modules\OperatorBill\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Modules\OperatorBill\Constants\OperatorTypeConstant;

class OperatorSeeder extends Seeder
{
    public function run()
    {
        $operators = [
            ['name' => 'Grameenphone', 'address' => 'Dhaka', 'phone' => '01700000000', 'email' => null, 'type' => OperatorTypeConstant::MOBILE],
            ['name' => 'Banglalink', 'address' => 'Dhaka', 'phone' => '01900000000', 'email' => null, 'type' => OperatorTypeConstant::MOBILE],
            ['name' => 'Robi', 'address' => 'Dhaka', 'phone' => null, 'email' => null, 'type' => OperatorTypeConstant::MOBILE],
            ['name' => 'Teletalk', 'address' => 'Dhaka', 'phone' => '01500000000', 'email' => null, 'type' => OperatorTypeConstant::MOBILE],
            ['name' => 'NovoTel', 'address' => 'Dhaka', 'phone' => null, 'email' => null, 'type' => OperatorTypeConstant::IOS],
            ['name' => 'Softex Communication', 'address' => 'Dhaka', 'phone' => null, 'email' => null, 'type' => OperatorTypeConstant::ICX],
            ['name' => 'BTCL', 'address' => 'Dhaka', 'phone' => null, 'email' => null, 'type' => OperatorTypeConstant::ANS],
            ['name' => 'Mir Telecom', 'address' => 'Dhaka', 'phone' => null, 'email' => null, 'type' => OperatorTypeConstant::IOS],
            ['name' => 'Bangla Trac', 'address' => 'Dhaka', 'phone' => null, 'email' => null, 'type' => OperatorTypeConstant::IOS],
            ['name' => 'M & H Telecom', 'address' => 'Dhaka', 'phone' => null, 'email' => null, 'type' => OperatorTypeConstant::ICX],
            ['name' => 'BTCL', 'address' => 'Dhaka', 'phone' => null, 'email' => null, 'type' => OperatorTypeConstant::ICX],
            ['name' => 'Infobip', 'address' => 'Dhaka', 'phone' => null, 'email' => null, 'type' => OperatorTypeConstant::VENDOR],
        ];

        $this->db->table('operators')->insertBatch($operators);

    }
}
