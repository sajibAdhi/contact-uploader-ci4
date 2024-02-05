<?php

namespace App\Modules\Product\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductQrcodesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
            ],
            'product_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'null' => true,
                'default' => null,
            ],
            'batch_no' => [
                'type' => 'VARCHAR',
                'constraint' => 300,
                'null' => true,
            ],
            'qrcode' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('product_qrcodes');
    }

    public function down()
    {
        //
    }
}
