<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class StaffLogin extends Model
{
    use Searchable;

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
