<?php

namespace OperatorBill\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreteOperatorBillsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
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
            ],
            'effective_duration' => [
                'type' => 'BIGINT',
                'constraint' => 20,
            ],
            'voice_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'voice_amount_with_vat' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'sms_count' => [
                'type' => 'BIGINT',
                'constraint' => 20,
            ],
            'sms_rate' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'sms_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'sms_amount_with_vat' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('operator_id','operators','id','CASCADE','CASCADE');
        $this->forge->createTable('operator_bills');

    }

    public function down()
    {
        $this->forge->dropTable('operator_bills');
    }
}
