<?php

namespace App\Interfaces;

interface ServicesRepositoryInterface
{
    public function createService(array $serviceDetails);
    public function getServiceById(int $serviceId);
    public function getServices();
    public function updateService(int $serviceId, array $serviceDetails);
    public function deleteService(int $serviceId);
}
