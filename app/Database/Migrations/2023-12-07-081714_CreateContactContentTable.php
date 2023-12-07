<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactContentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'content' => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
            ],
            'contact_id' => [
                'type'              => 'BIGINT',
                'constraint'        => 20,
                'unsigned'          => true,
            ],
            'remarks' => [
                'type'              => 'TEXT',
                'null'              => true,
            ],
        ]);

        $this->forge->addForeignKey('contact_id', 'contacts', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addKey(['contact_id', 'content'], true);
        $this->forge->createTable('contact_content');
    }

    public function down()
    {
        //
    }
}
