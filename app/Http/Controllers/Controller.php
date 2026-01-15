<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Reusable tryCatch method for all controllers
    protected function tryCatch(callable $process): JsonResponse
    {
        try {
            DB::beginTransaction();
            $response = $process();
            DB::commit();
            return $response;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error: ' . $th->getMessage());
            Log::error($th->getTraceAsString());
            return response()->json(['error' => 'Something Went Wrong!'], 500);
        }
    }
    protected function response(array $data, int $status = 200): JsonResponse
    {
        return response()->json($data, $status);
    }
}
