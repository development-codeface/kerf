<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Assistant extends Authenticatable
{
    use Searchable, GlobalStatus ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ver_code_send_at' => 'datetime'
    ];

    public function loginLogs()
    {
        return $this->hasMany(AssistantLogin::class);
    }

    public function doctors(){
        return $this->belongsToMany(Doctor::class,'assistant_doctor_tracks')->with('department', 'location')->withTimestamps();
    }

    public function appointments(){
        return $this->hasMany(Appointment::class,'assistant');
    }

    // SCOPES
    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', Status::INACTIVE);
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
