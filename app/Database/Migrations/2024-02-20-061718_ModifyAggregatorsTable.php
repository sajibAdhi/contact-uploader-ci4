<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyAggregatorsTable extends Migration
{
    public function up()
    {
        // modify aggregators table to modify the name column unique,index
        $this->forge->modifyColumn('aggregators', [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'unique' => true,
                'index' => true,
            ],
        ]);
    }

    public function down()
    {
        // modify aggregators table to remove the unique,index from name column
        $this->forge->modifyColumn('aggregators', [
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);
    }
}
