<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    use Searchable;

    public function doctor(){
    	return $this->belongsTo(Doctor::class);
    }

    public function assistant(){
    	return $this->belongsTo(Assistant::class);
    }

    public function staff(){
    	return $this->belongsTo(Staff::class);
    }
}
