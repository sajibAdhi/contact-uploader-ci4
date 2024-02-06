<?php

namespace App\Modules\OperatorBill\Database\Migrations;

use App\Modules\OperatorBill\Constants\DBConstant;
use App\Modules\OperatorBill\Constants\SbuConstant;
use CodeIgniter\Database\Migration;

class CreateOperatorBillsHistory extends Migration
{
    public function up(): void
    {
        // get a copy of operator_bills table then rename it to operator_bills_history
        $this->db->simpleQuery('CREATE TABLE ' . DBConstant::OPERATOR_BILL_HISTORY_TABLE . ' LIKE ' . DBConstant::OPERATOR_BILL_TABLE);
        // remove the created_at and updated_at, deleted_at columns from the new table operator_bills_history
        $this->db->simpleQuery('ALTER TABLE ' . DBConstant::OPERATOR_BILL_HISTORY_TABLE . ' DROP COLUMN created_at');
        $this->db->simpleQuery('ALTER TABLE ' . DBConstant::OPERATOR_BILL_HISTORY_TABLE . ' DROP COLUMN updated_at');
        $this->db->simpleQuery('ALTER TABLE ' . DBConstant::OPERATOR_BILL_HISTORY_TABLE . ' DROP COLUMN deleted_at');
        // Add new columns to the new table operator_bills_history column 'previous_id', 'action', 'added_by', 'added_at';
        $this->db->simpleQuery('ALTER TABLE ' . DBConstant::OPERATOR_BILL_HISTORY_TABLE . ' ADD COLUMN previous_id BIGINT(20) UNSIGNED DEFAULT NULL AFTER id');
        $this->db->simpleQuery('ALTER TABLE ' . DBConstant::OPERATOR_BILL_HISTORY_TABLE . ' ADD COLUMN action ENUM("' . implode('", "', DBConstant::ACTION_ENUM) . '") DEFAULT NULL AFTER previous_id');
        $this->db->simpleQuery('ALTER TABLE ' . DBConstant::OPERATOR_BILL_HISTORY_TABLE . ' ADD COLUMN added_by BIGINT(20) UNSIGNED DEFAULT NULL AFTER action');
        $this->db->simpleQuery('ALTER TABLE ' . DBConstant::OPERATOR_BILL_HISTORY_TABLE . ' ADD COLUMN added_at DATETIME DEFAULT NULL AFTER added_by');

    }

    public function down(): void
    {
        $this->forge->dropTable(DBConstant::OPERATOR_BILL_HISTORY_TABLE);
    }
}
