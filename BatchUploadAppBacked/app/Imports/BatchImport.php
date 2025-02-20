<?php

namespace App\Imports;

use App\Jobs\ProcessBatchUpload;
use App\Models\Batch;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BatchImport implements ToArray, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function array(array $data)
    {
        $batch = Batch::create([
            'record' => count($data),
            'remarks' => 'Bulk Upload',
            'status' => 'processing'
        ]);

        ProcessBatchUpload::dispatch($batch->id, $data);
    }
}
