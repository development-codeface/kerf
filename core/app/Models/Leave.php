<?php
// app/Models/Leave.php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    // use SoftDeletes;

    protected $table = 'leaves';

    protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'leave_type',
        'reason',
        'approved',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

   
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id');
    }
}

?>