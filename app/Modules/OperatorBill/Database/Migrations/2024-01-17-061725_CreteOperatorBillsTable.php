<?php

namespace App\Modules\OperatorBill\Database\Migrations;

use CodeIgniter\Database\Migration;
use App\Modules\OperatorBill\Constants\SbuConstant;

class CreteOperatorBillsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'sbu' => [
                'type' => 'ENUM',
                'constraint' => SbuConstant::all(),
                'null' => false,
            ],
            'year' => [
                'type' => 'YEAR',
            ],
            'month' => [
                'type' => 'INT',
                'constraint' => 2,
            ],
            'operator_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'successful_calls' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => true,
                'default' => null,
            ],
            'effective_duration' => [
                'type' => 'double',
                'null' => true,
                'default' => null,
            ],
            'voice_amount' => [
                'type' => 'double',
                'null' => true,
                'default' => null,
            ],
            'voice_amount_with_vat' => [
                'type' => 'double',
                'null' => true,
                'default' => null,
            ],
            'sms_count' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => true,
                'default' => null,
            ],
            'sms_amount' => [
                'type' => 'double',
                'null' => true,
                'default' => null,
            ],
            'sms_amount_with_vat' => [
                'type' => 'double',
                'null' => true,
                'default' => null,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime default null',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('operator_bills');
    }

    public function down()
    {
        $this->forge->dropTable('operator_bills');
    }
}
