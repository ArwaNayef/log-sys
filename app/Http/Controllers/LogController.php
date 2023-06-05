<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index()
    {
        // Retrieve all logs
        $logs = ActivityLog::all();
        return response()->json($logs);
    }

    public function show($id)
    {
        $log=ActivityLog::find($id);
        return response()->json($log);
    }

    public function getUnverifiedLogs()
    {
        // Retrieve logs that are not yet verified
        $unverifiedLogs = ActivityLog::where('note', 'not verified')->get();

        return response()->json($unverifiedLogs);
    }

    public function store(Request $request)
    {
        // Create a new log
        $log = ActivityLog::create($request->all());
        return response()->json($log, 201);
    }

    public function updateVerificationStatus($id)
    {
        // Update the verification status of the log
        $log=ActivityLog::find($id);
       $log->update(['note'=>'verified']);

        return response()->json($log);
    }

    public function update(Request $request, ActivityLog $log)
    {
        // Update an existing log
        $log->update($request->all());
        return response()->json($log);
    }

    public function destroy(ActivityLog $log)
    {
        // Delete a log
        $log->delete();
        return response()->json(null, 204);
    }
}
