<?php

namespace App\Repositories\Implementators\Eloquent\Staff;

use App\Repositories\Interfaces\Staff\DistributionRepositoryInterface;

use App\DTO\Staff\DistributeDTO;

class DistributionRepositoryImplementator implements DistributionRepositoryInterface
{
    // Distribute function
    public function distribute(DistributeDTO $orderDTO) {

        // Checking and distribution
        if ($orderDTO->getObtaining() === 'pickup') {

            // Create order for picking up
            static::createPickupOrder($orderDTO);

        } else if ($orderDTO->getObtaining() === 'cafe') {

            // Create order for hall
            static::craeteHallOrder($orderDTO);

        } else {

            // Create order for delivery
            static::createDeliveryOrder($orderDTO);
        }
    }

    // ===============================================

    public static function createPickupOrder(DistributeDTO $orderDTO) {
        
        $pickupOrder = static::collectOrderData($orderDTO);
    }

    // ===============================================

    public static function craeteHallOrder(DistributeDTO $orderDTO) {

        $hallOrder = static::collectOrderData($orderDTO);
        
    }

    // ===============================================

    public static function createDeliveryOrder(DistributeDTO $orderDTO) {

        $deliveryOrder = static::collectOrderData($orderDTO);
        
    }

    // ===============================================

    public static function collectOrderData(DistributeDTO $orderDTO) {
        $order = [
            'customer_name' => $orderDTO->getCustomerName(),
            'customer_phone' => $orderDTO->getCustomerPhone(),
            'obtaining' => $orderDTO->getObtaining(),
            'total_price' => $orderDTO->getTotalPrice(),
            'status' => $orderDTO->getStatus(),
        ];

        return $order;
    }
}