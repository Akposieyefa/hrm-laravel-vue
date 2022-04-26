<?php
namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SystemHelper
{
    public function cleanStringHelper($string): mixed
    {
        if (is_null($string)) {
            return "";
        }else {
            return $string;
        }
    }

    public function createStaffHelper(): JsonResponse
    {
        return response()->json([
            "data" => [
                'departments' =>  DB::table('departments')->where('organization_id', '=', auth()->user()->organization->id)->get(),
                'levels' =>  DB::table('levels')->where('organization_id', '=', auth()->user()->organization->id)->get()
            ]
        ], 200);
    }

    public function dashBoardCountHelper(): JsonResponse
    {
        return response()->json([
            "data" => [
                'departments' =>  DB::table('departments')->count(),
                'levels' =>  DB::table('levels')->count(),
                'staffs' => DB::table('staffs')->count(),
                'unions' => DB::table('unions')->count()
            ]
        ], 200);
    }
}
