<?php

namespace App\Services;

use App\Models\AggregatorModel;
use ReflectionException;

class AggregatorService
{
    public AggregatorModel $aggregatorModel;

    public function __construct()
    {
        $this->aggregatorModel = new AggregatorModel();
    }

    /**
     * @throws ReflectionException
     */
    public function findOrInsert(string $name): object
    {
        $aggregator = $this->existingAggregator($name);

        if (empty($aggregator)) {
            $this->aggregatorModel->insert(['name' => $name]);
            $aggregator = $this->existingAggregator($name);
        }

        return $aggregator;
    }

    /**
     * @param string $name
     * @return array|object|null
     */
    private function existingAggregator(string $name)
    {
        return $this->aggregatorModel->where('name', $name)->first();
    }

    public function find($aggregator_id)
    {
        return $this->aggregatorModel->find($aggregator_id);
    }
}