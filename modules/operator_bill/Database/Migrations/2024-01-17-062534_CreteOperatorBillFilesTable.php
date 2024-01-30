<?php

namespace Modules\OperatorBill\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreteOperatorBillFilesTable extends Migration
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
            'operator_bill_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'file_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'file_path' => [
                'type' => 'TEXT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime default null',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('operator_bill_files');
    }

    public function down()
    {
        $this->forge->dropTable('operator_bill_files');
    }
}
