<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Customer;
use App\Models\MainRoom;
use Illuminate\Http\Request;
use App\Log;
use Spatie\Activitylog\Models\Activity;

class MainRoomController extends Controller
{
    public function index()
    {
        // Retrieve all main-rooms with the latest verified log and drafts
        $mainRooms = MainRoom::with(['logs' => function ($query) {
            $query->latest()->whereIn('note', ['verified', 'draft']);
        }])->get();

        return response()->json($mainRooms);
    }

    public function acceptLog(MainRoom $mainRoom, Log $log)
    {
        // Check if the log belongs to the main-room
        if ($log->main_room_id !== $mainRoom->id) {
            return response()->json(['error' => 'Log does not belong to the main-room'], 400);
        }

        // Update the log status based on the customer's decision
        if ($log->note === 'draft') {
            $log->note = 'accepted';
        } else {
            $log->note = 'rejected';
        }
        $log->save();

        // Return the updated log
        return response()->json($log);
    }


    public function show(MainRoom $mainRoom)
    {
        // Retrieve a specific main-room
        return response()->json($mainRoom);
    }

    public function store(Request $request)
    {
        // Create a new main-room
        $mainRoom = MainRoom::create($request->all());
        $mainRoom->activities->last();
        $mainRoom->activities()->create([
            'properties'=>$request->all(),
            'version'=>1,
            'causer_type'=>"App\Models\Customer", 'causer_id'=>1
        ]);

        // Create a new log entry for the main-room creation
//        $log = new ActivityLog();
//        $log->properties=json_decode($mainRoom);
//        $log->subject_type="Main Room";
//        $log->subject_id=$mainRoom->id;
//        $log->note = 'not verified'; // Mark the log as not verified
        
//        activity()
//            ->performedOn($mainRoom)
//            ->causedBy($customer)
//            ->withProperties(json_decode($mainRoom))
//            ->log('room created');

        return response()->json($mainRoom);
    }

    public function update(Request $request,  $id)
    {

        $activity = Activity::where('subject_id', $id)->latest()->value('version');

        $mainRoom=MainRoom::find($id);
//        dd($mainRoom);
        $customer=Customer::find(1);
        // Update an existing main-room
        $mainRoom->update($request->all());
        $mainRoom->activities->last();
        $mainRoom->activities()->create([
            'properties'=>$request->all(),
            'version'=>$activity+1,
            'causer_type'=>"App\Models\Customer", 'causer_id'=>1
        ]);

        // Create a new log entry for the update
//        $log = new ActivityLog();
//        $log->main_room_id = $mainRoom->id;
//        $log->note = 'not verified'; // Mark the log as not verified
//        $log->save();

//        $activity=Activity::where('subject_id', $id)->get('version')->last();

//      $activity =new    ActivityLog();
//       $log =  activity()  ->performedOn($mainRoom)
//            ->causedBy($customer)
//            ->withProperties($request->all())
//            ->log('room edited')
//          ;
//        ;
//     $d=   $log ->  getExtraProperty('causer_id');
//     dd($d);
////        dd($log->id);
//        $activityLog = ActivityLog::find($log->id);
//        $activityLog->version  = "V1";
//        $activityLog->save();

        return response()->json($mainRoom);
    }

    public function destroy(MainRoom $mainRoom)
    {
        // Delete a main-room
        $mainRoom->delete();
        return response()->json(null, 204);
    }
}
