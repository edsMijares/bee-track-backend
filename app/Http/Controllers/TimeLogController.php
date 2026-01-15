<?php

namespace App\Http\Controllers;

use App\Models\SettingsModel;
use Illuminate\Http\Request;
use App\Models\TimeLogModel;
use App\Models\UserModel;
use Ramsey\Uuid\Type\Time;

class TimeLogController extends Controller
{
    public function create(Request $request)
    {
        return $this->tryCatch(function () use ($request) {
            $LogToday = TimeLogModel::where('user_id', $request->user()->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();
            if ($LogToday) {
                if ($LogToday->created_at != $LogToday->updated_at) {
                    return $this->response([
                        'message' => 'You can only time in and out once per day.',
                    ], 200);
                }
                $LogToday->touch();
            }else{
                $LogToday = TimeLogModel::create([
                    'user_id' => $request->user()->id,
                ]);
            }
            return $this->response([
                'message' => 'Time log created successfully.',
            ], 200);
        });
    }
    public function read(Request $request)
    {
        return $this->tryCatch(function () use ($request) {
            $timeLogs = TimeLogModel::where('user_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            $timeLogs->getCollection()->transform(function ($log) {
                return [
                    'created_at' => $log->created_at,
                    'updated_at' => $log->updated_at != $log->created_at ? $log->updated_at : null,
                ];
            });
            return $this->response([
                'time_logs' => $timeLogs,
                'min_working_hours' => SettingsModel::getValueByKey('DEFAULT_WORKING_HOURS') ?? null,
            ], 200);
        });
    }
}
