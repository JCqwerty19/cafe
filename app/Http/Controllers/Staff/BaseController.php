<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Staff\DistributionService;

class BaseController extends Controller
{
    // Staff base controller constructor
    public function __construct(
        protected DistributionService $distributionService,
    ) {
        $this->distributionService = $distributionService;
    }

    // Distribution service getter
    public function getDistributionService(): DistributionService {
        return $this->distributionService;
    }
}
