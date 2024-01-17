<?php namespace OperatorBill\Services;

use OperatorBill\Models\BillFileModel;
use OperatorBill\Models\OperatorBillModel;
use ReflectionException;

class OperatorBillService
{
    private OperatorBillModel $operatorBillModel;
    private BillFileModel $billFileModel;

    public function __construct()
    {
        $this->operatorBillModel = new OperatorBillModel();
        $this->billFileModel = new BillFileModel();

    }

    /**
     * @throws ReflectionException
     */
    public function store($data, $files): bool
    {
        $this->operatorBillModel->db->transStart(true);

        // Insert the data and get the ID of the inserted record
        $operatorBillId = $this->operatorBillModel->insert($data);

        $filesData = [];
        // Loop through the files
        foreach ($files as $file) {
            // Move the file to a specific directory
            $filePath = 'uploads/' . $file->getRandomName();
            $file->move($filePath);

            // Prepare the data to update the record with the file path
            $filesData[] = [
                'operator_bill_id' => $operatorBillId,
                'file_name' => $file->getName(),
                'file_path' => $filePath,
            ];
        }

        // Insert the file data into the database
        $this->billFileModel->insertBatch($filesData);

        $this->operatorBillModel->db->transComplete();
        return $this->operatorBillModel->db->transStatus();
    }
}