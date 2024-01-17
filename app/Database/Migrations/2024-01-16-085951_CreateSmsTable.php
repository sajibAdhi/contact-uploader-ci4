<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSmsTable extends Migration
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
                'null'       => true,
            ],
            'from_contact_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
            ],
            'to_contact_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'sent', 'failed'],
                'default'    => 'pending',
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('contact_id', 'contacts', 'id', 'CASCADE', 'CASCADE');
//        $this->forge->addUniqueKey(['content', 'contact_id']);
        $this->forge->createTable('sms');
    }

    public function down()
    {
        $this->forge->dropTable('sms');
    }
}
