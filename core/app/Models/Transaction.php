<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Searchable;

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}
