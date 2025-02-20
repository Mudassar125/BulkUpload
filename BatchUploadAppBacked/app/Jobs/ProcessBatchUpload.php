<?php

namespace App\Jobs;

use App\Models\Batch;
use App\Models\BatchRecord;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessBatchUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batchId;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($batchId, $data)
    {
        $this->batchId = $batchId;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->data as $record){
            BatchRecord::create([
                'batch_id' => $this->batchId,
                'city' => $record['city'],
                'society' => $record['society'],
                'block' => $record['block'],
                'marla' => $record['marla'],
                'size' => $record['size'],
                'price' => $record['price'],
                'status' => 'pending'
            ]);
        }

        Batch::where('id',$this->batchId)->update(['status' => 'completed']);
    }
}
