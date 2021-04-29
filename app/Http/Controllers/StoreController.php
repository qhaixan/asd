<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

/**
 * Class StoreController.
 */
class StoreController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'key' => 'required',
            'value' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([ 'status'=>false, 'error'=>$validator->errors() ]);
        }
        Store::create($data);
        return response()->json([ 'status'=>true ]);
    }

    public function getval(Request $request) {
        //get latest value based on key
        //if time given, return value at that moment
        $data = $request->all();
        $validator = Validator::make($data, [
            'key' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([ 'status'=>false, 'error'=>$validator->errors() ]);
        }
        $store = Store::where('key', $data['key']);

        
        if ($time = $data['time']) {
            if (is_numeric($time)) {
                $time = Carbon::createFromTimestamp($time)->toDateTimeString();
            }
            $store->where('created_at', '<=', $time);
        }
        $value = $store->orderBy('created_at','DESC')->pluck('value')->first();
        return response()->json($value);
    }

    public function getCurrentVals() {
        $result = Store::
        orderBy('key')
        ->orderBy('created_at','DESC')
        ->get()
        ->unique('key')
        ->toArray();

        //reset array index after unique filter
        $result = array_values($result);
        return response()->json($result);
    }
}