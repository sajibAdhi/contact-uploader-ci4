<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactContentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'aggregator_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'null'   => false,
            ],
            'date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'form_contact_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'null'   => false,
            ],
            'to_contact_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'null'   => false,
            ],
            'operator_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'content' => [
                'type' => 'VARCHAR',
                'constraint' => 160,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'sent', 'delivered', 'read', 'failed'],
                'null' => false,
                'default' => 'pending',
            ],
            'remarks' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at TIMESTAMP default null on update CURRENT_TIMESTAMP',
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('aggregator_id');
        $this->forge->addKey('date');
        $this->forge->addKey('form_contact_id');
        $this->forge->addKey('to_contact_id');
        $this->forge->addKey('content');
        $this->forge->addKey('operator_name');
        $this->forge->addKey('status');
        $this->forge->addUniqueKey(['form_contact_id', 'to_contact_id', 'content','date']);
        $this->forge->createTable('contact_content');
    }

    public function down()
    {
        $this->forge->dropTable('contact_content');
    }
}
