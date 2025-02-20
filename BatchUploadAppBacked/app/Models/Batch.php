<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = ['record', 'remarks', 'status'];

    public function records()
    {
        return $this->hasMany(BatchRecord::class);
    }
}
