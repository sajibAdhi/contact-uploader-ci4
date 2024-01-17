<?php

namespace OperatorBill\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreteOperatorTable extends Migration
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
            'operator_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'operator_address' => [
                'type' => 'TEXT',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('operators');
    }

    public function down()
    {
        $this->forge->dropTable('operators');
    }
}
