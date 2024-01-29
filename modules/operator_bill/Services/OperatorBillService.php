<?php namespace Modules\OperatorBill\Services;

use Modules\OperatorBill\Models\OperatorBillFileModel;
use Modules\OperatorBill\Models\OperatorBillModel;
use Modules\OperatorBill\Models\OperatorModel;
use ReflectionException;

class OperatorBillService
{
    public OperatorBillModel $operatorBillModel;
    private OperatorBillFileModel $operatorBillFileModel;
    public OperatorModel $operatorModel;

    public function __construct()
    {
        $this->operatorModel = new OperatorModel();
        $this->operatorBillModel = new OperatorBillModel();
        $this->operatorBillFileModel = new OperatorBillFileModel();

    }

    public function find(int $id)
    {
        $operatorBill = $this->operatorBillModel->find($id);
        $operatorBill->operator = $this->operatorModel->find($operatorBill->operator_id);
        $operatorBill->files = $this->operatorBillFileModel->where('operator_bill_id', $operatorBill->id)->findAll();

        return $operatorBill;
    }


    /**\
     * findAll with files
     * @return array
     */
    public function findAll(): array
    {
        $operatorBills = $this->operatorBillModel
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->findAll();

        array_walk($operatorBills, function (&$operatorBill) {
            $operatorBill->operator = $this->operatorModel->find($operatorBill->operator_id);
            $operatorBill->files = $this->operatorBillFileModel->where('operator_bill_id', $operatorBill->id)->findAll();
        });

        return $operatorBills;
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
            $filePath = 'uploads' . DIRECTORY_SEPARATOR . 'operator_bills' . DIRECTORY_SEPARATOR;
            $file->move($filePath, $file_name);

            $fileData['file_path'] = "$filePath/$file_name";

            // Prepare the data to update the record with the file path
            $filesData[] = $fileData;
        }


        if (!empty($filesData)) {
            $this->operatorBillFileModel->insertBatch($filesData);
        }
        // Insert the file data into the database

        $this->operatorBillModel->db->transComplete();
        return $this->operatorBillModel->db->transStatus();
    }


    /**
     * @throws ReflectionException
     */
    public function update($id, object $postData, $files): bool
    {
        $this->operatorBillModel->db->transStart();

        // Update the operator bill
        $this->operatorBillModel->update($id, $postData);

        $filesData = [];
        // Loop through the files
        foreach ($files as $file) {
            if (!$file->isValid()) {
                continue;
            }
            $fileData['operator_bill_id'] = $id;
            $fileData['file_name'] = $file->getName();

            // Move the file to a specific directory
            $file_name = $file->getRandomName();
            $filePath = 'uploads' . DIRECTORY_SEPARATOR . 'operator' . DIRECTORY_SEPARATOR;
            $file->move($filePath, $file_name);

            $fileData['file_path'] = "$filePath/$file_name";

            // Prepare the data to update the record with the file path
            $filesData[] = $fileData;
        }

        // Insert the file data into the database
        if (!empty($filesData)) {
            $this->operatorBillFileModel->insertBatch($filesData);
        }

        $this->operatorBillModel->db->transComplete();
        return $this->operatorBillModel->db->transStatus();
    }

    public function getDistinctYears()
    {
        return $this->operatorBillModel->select('year')->distinct()->orderBy('year', 'DESC')->findAll();
    }

    public function getDistinctMonths()
    {
        return $this->operatorBillModel->select('month')->distinct()->orderBy('month', 'DESC')->findAll();
    }

    public function filter(array $array): OperatorBillService
    {
        if (!empty($array['sbu'])) {
            $this->operatorBillModel->where('sbu', $array['sbu']);
        }

        if (!empty($array['year'])) {
            $this->operatorBillModel->where('year', $array['year']);
        }

        if (!empty($array['month'])) {
            $this->operatorBillModel->where('month', $array['month']);
        }

        if (!empty($array['operator'])) {
            $this->operatorBillModel->where('operator_id', $array['operator']);
        }
        return $this;
    }
}