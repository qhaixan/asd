<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Support\Facades\DB;

/**
 * Class StoreController.
 */
class StoreController extends Controller
{
    public function store() {
        //insert key - val
    }

    public function getval() {
        //get latest value based on key
        //if timestamp given, return value at that moment
    }

    public function getCurrentVals() {
        $result = Store::
        orderBy('key')
        ->orderBy('created_at','DESC')
        ->get()
        ->unique('key');
        //reset array index after unique filter
        $result = array_values((Array) $result);
        return response()->json($result);
    }
}