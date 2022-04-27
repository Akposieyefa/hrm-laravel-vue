<?php
namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class SystemHelper
{
    /**
     * @param $string
     * @return mixed
     */
    public function cleanStringHelper($string): mixed
    {
        if (is_null($string)) {
            return "";
        }else {
            return $string;
        }
    }

    /**
     * @return JsonResponse
     */
    public function createStaffHelper(): JsonResponse
    {
        return response()->json([
            "data" => [
                'departments' =>  DB::table('departments')->where('organization_id', '=', auth()->user()->organization->id)->get(),
                'levels' =>  DB::table('levels')->where('organization_id', '=', auth()->user()->organization->id)->get()
            ]
        ], 200);
    }

    /**
     * @return JsonResponse
     */
    public function dashBoardCountHelper(): JsonResponse
    {
        return response()->json([
            "data" => [
                'departments' =>  DB::table('departments')->where( 'organization_id', '=', auth()->user()->organization->id)->count(),
                'projects' =>  DB::table('projects')->where('organization_id', '=', auth()->user()->organization->id)->count(),
                'employees' => DB::table('employees')->where('organization_id', '=', auth()->user()->organization->id)->count(),
            ]
        ], 200);
    }
}
