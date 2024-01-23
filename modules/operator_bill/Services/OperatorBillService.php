<?php namespace OperatorBill\Services;

use OperatorBill\Models\OperatorBillFileModel;
use OperatorBill\Models\OperatorBillModel;
use OperatorBill\Models\OperatorModel;
use ReflectionException;

class OperatorBillService
{
    public OperatorBillModel $operatorBillModel;
    private OperatorBillFileModel $billFileModel;
    public OperatorModel $operatorModel;

    public function __construct()
    {
        $this->operatorModel = new OperatorModel();
        $this->operatorBillModel = new OperatorBillModel();
        $this->billFileModel = new OperatorBillFileModel();

    }

    /**
     * @throws ReflectionException
     */
    public function store($data, $files): bool
    {
        $this->operatorBillModel->db->transStart();

        // Insert the data and get the ID of the inserted record
        $operatorBillId = $this->operatorBillModel->insert($data);

        $filesData = [];
        // Loop through the files
        foreach ($files as $file) {
            if (!$file->isValid()) {
                continue;
            }
            $fileData['operator_bill_id'] = $operatorBillId;
            $fileData['file_name'] = $file->getName();

            // Move the file to a specific directory
            $file_name = $file->getRandomName();
            $filePath = 'uploads' . DIRECTORY_SEPARATOR . 'operator' . DIRECTORY_SEPARATOR;
            $file->move($filePath, $file_name);

            $fileData['file_path'] = "$filePath/$file_name";

            // Prepare the data to update the record with the file path
            $filesData[] = $fileData;
        }

        if (!empty($filesData)) {
            $this->billFileModel->insertBatch($filesData);
        }
        // Insert the file data into the database

        $this->operatorBillModel->db->transComplete();
        return $this->operatorBillModel->db->transStatus();
    }

    /**\
     * findAll with files
     * @return array
     */
    public function findAll(): array
    {
        $operatorBills = $this->operatorBillModel->orderBy('year', 'DESC')->orderBy('month', 'DESC')->findAll();

        array_walk($operatorBills, function (&$operatorBill) {
            $operatorBill->operator = $this->operatorModel->find($operatorBill->operator_id);
            $operatorBill->files = $this->billFileModel->where('operator_bill_id', $operatorBill->id)->findAll();
        });

        return $operatorBills;
    }

    public function find(int $id)
    {
        $operatorBill = $this->operatorBillModel->find($id);
        $operatorBill->operator = $this->operatorModel->find($operatorBill->operator_id);
        $operatorBill->files = $this->billFileModel->where('operator_bill_id', $operatorBill->id)->findAll();

        return $operatorBill;
    }
}