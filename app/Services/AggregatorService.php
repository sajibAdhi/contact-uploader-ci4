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
    public function findAllOrInsertBatchByAggregatorName(array $aggregatorNames): array
    {
        $existingAggregators = $this->existingAggregators($aggregatorNames);
        $existingAggregators = array_column($existingAggregators, 'name');

        $newAggregatorNames = array_diff($aggregatorNames, $existingAggregators);

        if (!empty($newAggregatorNames)) {
            $this->aggregatorModel->insertBatch(array_map(
                static fn($aggregatorName) => ['name' => $aggregatorName],
                $newAggregatorNames
            ));
        }

        return $this->existingAggregators($aggregatorNames);
    }

    private function existingAggregators(array $aggregatorNames): array
    {
        return $this->aggregatorModel->whereIn('name', $aggregatorNames)->findAll();
    }

    public function find($aggregator_id)
    {
        return $this->aggregatorModel->find($aggregator_id);
    }
}