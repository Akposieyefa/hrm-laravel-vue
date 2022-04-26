<?php

namespace App\Http\Controllers\Api;

use App\Helpers\SystemHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    private SystemHelper $helper;

    public function __construct(SystemHelper $helper)
    {
        $this->helper = $helper;
    }

    public function createHelper(): \Illuminate\Http\JsonResponse
    {
        return  $this->helper->createStaffHelper();
    }

    public function dashboardHelper(): \Illuminate\Http\JsonResponse
    {
        return $this->helper->dashBoardCountHelper();
    }


}
