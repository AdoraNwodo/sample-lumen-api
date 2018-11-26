<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function getAllEvents(){

        $events = Event::all();

        return $this->draftResponseArray("success", "events", $events, 200);
    }



    public function getEvent($id){

        $event = Event::find($id);

        if(is_null($event)){
            return $this->draftResponseArray("error", "no_event_found", [], 500);
        }

        return $this->draftResponseArray("success", "event", $event, 200);
    }



    public function createEvent(Request $request){

        $event = Event::create($request->all());

        if(is_null($event)){
            return $this->draftResponseArray("error", "no_event_created", [], 500);
        }

        return $this->draftResponseArray("success", "event_created", $event, 200);

    }



    public function draftResponseArray($status, $message, $data, $code){
        
        $response = array();
        $response["status"] = $status;
        $response["message"] = $message;
        $response["data"] = $data;

        return response()->json($response, $code);
    }
}
