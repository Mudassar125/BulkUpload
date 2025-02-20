<?php

namespace App\Http\Controllers;

use App\Imports\BatchImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Batch;


class BatchController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new BatchImport, $request->file('file'));

        return response()->json(['message' => 'Upload started. Data will be processed in batches']);
    }

    public function index()
    {
        return response()->json(Batch::all());
    }
}
