<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Menyimpan data tap absensi dari perangkat IoT.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeTap(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rfid_uid' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }

        $user = User::where('rfid_uid', $request->rfid_uid)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found. RFID card is not registered.'
            ], 404); // 404 Not Found
        }

        $todaySchedule = Schedule::whereDate('start_time', today())->first();

        if (!$todaySchedule) {
            return response()->json([
                'status' => 'error',
                'message' => 'No active schedule for today.'
            ], 404); // 404 Not Found
        }

        $attendance = Attendance::where('user_id', $user->id)
            ->where('schedule_id', $todaySchedule->id)
            ->first();

        if (!$attendance) {
            return response()->json([
                'status' => 'error',
                'message' => 'Attendance record not found for this user and schedule.'
            ], 404);
        }

        if ($attendance->status !== 'Alfa') {
            return response()->json([
                'status' => 'warning',
                'message' => 'You have already checked in.'
            ], 409); // 409 Conflict
        }

        $appTimezone = config('app.timezone');
        $currentTime = now($appTimezone);

        $todaySchedules = Schedule::whereDate('start_time', $currentTime->toDateString())->get();

        if ($todaySchedules->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'No active schedule for today.'], 404);
        }

        $closestSchedule = null;
        $smallestDiff = PHP_INT_MAX;

        foreach ($todaySchedules as $schedule) {
            $startTime = Carbon::parse($schedule->start_time, $appTimezone);
            $diff = abs($startTime->diffInMinutes($currentTime)); // Gunakan nilai absolut

            if ($diff < $smallestDiff) {
                $smallestDiff = $diff;
                $closestSchedule = $schedule;
            }
        }

        if ($smallestDiff > 120) {
            return response()->json([
                'status' => 'error',
                'message' => 'No schedule is active at this time.'
            ], 404);
        }


        $attendance = Attendance::where('user_id', $user->id)
            ->where('schedule_id', $closestSchedule->id)
            ->first();

        if (!$attendance) {
            return response()->json(['status' => 'error', 'message' => 'Attendance record not found.'], 404);
        }
        if ($attendance->status !== 'Alfa') {
            return response()->json(['status' => 'warning', 'message' => 'You have already checked in for ' . $closestSchedule->name], 409);
        }

        $startTime = Carbon::parse($closestSchedule->start_time, $appTimezone);
        $status = 'Hadir';
        $latenessDuration = 0;

        if ($currentTime->gt($startTime)) {
            $latenessDuration = $startTime->diffInMinutes($currentTime);
        }

        $attendance->update([
            'status' => $status,
            'tap_time' => $currentTime,
            'lateness_duration_minutes' => $latenessDuration,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance recorded successfully!',
            'data' => [
                'user_name' => $user->name,
                'schedule_name' => $todaySchedule->name,
                'tap_time' => $currentTime->toDateTimeString(),
                'attendance_status' => $latenessDuration > 0 ? 'Terlambat' : 'Tepat Waktu',
                'lateness_minutes' => $latenessDuration
            ]
        ], 200); // 200 OK
    }
}
