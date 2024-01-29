<?php

namespace Modules\OperatorBill\Database\Migrations;

use CodeIgniter\Database\Migration;
use Modules\OperatorBill\Constants\OperatorTypeConstant;

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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => OperatorTypeConstant::all(),
                'null' => false,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime default null',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('operators');

    }

    public function down()
    {
        $this->forge->dropTable('operators');
    }
}
