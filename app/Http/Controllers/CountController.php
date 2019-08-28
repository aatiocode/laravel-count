<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Events\MyEvent;

class CountController extends Controller
{
    public function count(Request $request) {
        $count = $request->input('count');
        $param = $request->input('param');
        Log::debug("PAYLOAD: ",$request->all());
        
        $intervalTotal = $param;
        $total = 0;

        for ($data=1; $data <= $count; $data++) { 
            $progress = round(($data/$count)*100);

            if($data == $intervalTotal){
                $intervalTotal = $intervalTotal + $param;
                Log::debug("data : ".$data);
                Log::debug("progress count: ".$progress);
                event(new MyEvent($progress));
            }

            if($data == $count){
                Log::debug("data : ".$data);
                Log::debug("progress count: ".$progress);
                event(new MyEvent($progress));
                $total  = $data;
            }
        }

        if($data) {
            Log::debug("RESPONSE: ",[
                'status' => 'success',
                'message' => 'Success Count',
                'data' => $total 
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Success Count',
                'data' => $total 
            ],200);
        }

        Log::debug("RESPONSE: ",[
            'status' => 'failed',
            'message' => 'Failed Count',
            'data' => ''
            ]);

        return response()->json([
            'status' => 'failed',
            'message' => 'Failed Count',
            'data' => ''
        ],500);

    }
}
