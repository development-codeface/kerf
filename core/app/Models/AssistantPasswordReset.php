<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssistantPasswordReset extends Model
{
    protected $table = "assistant_password_resets";
    protected $guarded = ['id'];
    public $timestamps = false;
}
