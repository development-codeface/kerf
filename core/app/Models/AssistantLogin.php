<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class AssistantLogin extends Model
{
    use Searchable;

    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }
}
