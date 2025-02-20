<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchRecord;


class BatchRecordController extends Controller
{
    public function index($batch_id)
    {
        return response()->json(BatchRecord::where('batch_id', $batch_id)->get());
    }

}
