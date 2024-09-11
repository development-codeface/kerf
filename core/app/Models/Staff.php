<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{

    public $table = "staff";

    use Searchable, GlobalStatus;

    public function loginLogs()
    {
        return $this->hasMany(StaffLogin::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class,'staff');
    }

    // SCOPES

    public function scopeActive()
    {
        return $this->where('status', Status::ACTIVE);
    }

    public function scopeInactive()
    {
        return $this->where('status', Status::INACTIVE);
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->status == Status::ACTIVE) {
                $html = '<span class="badge badge--success">' . trans("Active") . '</span>';
            } elseif ($this->status == Status::INACTIVE) {
                $html = '<span class="badge badge--danger">' . trans("Inactive") . '</span>';
            }
            return $html;
        });
    }
}
