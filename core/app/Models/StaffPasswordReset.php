<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffPasswordReset extends Model
{
    protected $table = "staff_password_resets";
    protected $guarded = ['id'];
    public $timestamps = false;
}
