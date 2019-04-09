<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Site;
use App\LogItem;
use Carbon\Carbon;

class LogController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required',
            'message' => '',
            'level' => 'required',
            'datetime' => 'required',
            'context' => ''
        ]);
           
        // TODO: Check origin

        $site = Site::where('api_key', $data['key'])->first();
        
        // check if exists web site with the given api key
        if (!$site) {
            return response()->json([
                'message' => 'Api Key is invalid',
                'status' => 'fail',
                'code' => 403
            ], 403);
        }

        // Removes api key from data for precisting proposes
        unset($data['key']);

        // attach the site id 
        $data['site_id'] = $site->id;
        $data['datetime'] = Carbon::parse($data['datetime']['date']);
        $data['context'] = json_encode($data['context']);

        Log::info(json_encode($data));
        
        $log = LogItem::create($data);

        return response()->json([
            'message' => 'Stored with success',
            'status' => 'success',
            'code' => 201
        ], 201);
    }
}
