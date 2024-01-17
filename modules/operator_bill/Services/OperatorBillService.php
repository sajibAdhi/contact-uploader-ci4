<?php namespace OperatorBill\Services;

class OperatorBillService
{
    public function __construct()
    {

    }

    public function store($data)
    {
        $this->operatorBillModel->db->transStart();

        $this->operatorBillModel->insert($data);

        $this->operatorBillModel->db->transComplete();
        return $this->operatorBillModel->db->transStatus();
    }

    public function read()
    {
        return $this->operatorBillModel->findAll();
    }

    public function update($id, $data)
    {
        $this->operatorBillModel->update($id, $data);
    }

    public function delete($id)
    {
        $this->operatorBillModel->delete($id);
    }
}