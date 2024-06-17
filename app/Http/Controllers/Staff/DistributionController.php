<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

use App\Models\Client\Order;

use App\DTO\Staff\DistributeDTO;

class DistributionController extends BaseController
{
    public function distribute(Order $order) {

        $orderDTO = new DistributeDTO(
            order_id: $order->id,
            obtaining: $order->obtaining,
            status: $order->status,
        );

        $this->getDistributionService()->distribute($orderDTO);

        if ($order->obtaining === 'cafe') {
            // create order for hall
        } else if ($order->obteining === 'pickup') {
            // craete order for picj=kup
        } else {
            // Create order for delivery
        }
    }
}
