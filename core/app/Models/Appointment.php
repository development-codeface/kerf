<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Appointment extends Model
{
    use Searchable;

    protected $guarded = ['id'];


    public function doctor()
    {

        return $this->belongsTo(Doctor::class);
    }

    public function staff()
    {

        return $this->belongsTo(Staff::class, 'added_staff_id');
    }

    public function assistant()
    {
        return $this->belongsTo(Assistant::class, 'added_assistant_id');
    }

    public function deletedByStaff()
    {
        return $this->belongsTo(Staff::class, 'delete_by_staff');
    }

    public function deletedByDoctor()
    {
        return $this->belongsTo(Doctor::class, 'delete_by_doctor');
    }

    public function deletedByAssistant()
    {
        return $this->belongsTo(Assistant::class, 'delete_by_assistant');
    }

    public function deposits($query)
    {
        return $query->hasMany(Deposit::class)->orderBy('id', 'desc');
    }

    public function scopeCompleteAppointment($query)
    {
        return $query->where('try', Status::YES)->where('is_complete', Status::APPOINTMENT_COMPLETE)->where('is_delete', Status::NO);
    }

    public function scopeNewAppointment($query)
    {
        return $query->where('try', Status::YES)->where('is_complete', Status::APPOINTMENT_INCOMPLETE)->where('is_delete', Status::NO);
    }

    public function scopeHasDoctor($query)
    {
        return $query->whereHas('doctor', function ($query) {
            $query->where('status', Status::ACTIVE);
        });
    }

    public function paymentBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->payment_status == Status::APPOINTMENT_CASH_PAYMENT) {
                $html = '<span class="badge badge--primary">' . trans('Cash') . '</span>';
            } elseif ($this->payment_status == Status::APPOINTMENT_PAID_PAYMENT) {
                $html = '<span class="badge badge--success">' . trans('Paid') . '</span>';
            } elseif ($this->payment_status == Status::APPOINTMENT_PENDING_PAYMENT) {
                $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
            }
            return $html;
        });
    }

    public function serviceBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->is_complete == Status::APPOINTMENT_COMPLETE) {
                $html = '<span class="badge badge--primary">' . trans('Done') . '</span>';
            } elseif ($this->is_complete == Status::APPOINTMENT_INCOMPLETE) {
                $html = '<span class="badge badge--warning">' . trans('Pending') . '</span>';
            }
            return $html;
        });
    }

    public function addedByBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->delete_by_admin) {
                $html = '<span class="text--small badge badge--primary">' . trans('Admin') . '</span>';
            } elseif ($this->added_staff_id) {
                $html = '<span>' . trans($this->staff->name) . '</span><br>
                <span class="text--small badge badge--primary">' . trans('Staff') . '</span>';
            } elseif ($this->added_assistant_id) {
                $html = '<span>' . trans($this->assistant->name) . '</span><br>
                <span class="text--small badge badge--dark">' . trans('Assistant') . '</span>';
            } elseif ($this->added_doctor_id) {
                $html = '<span>' . trans($this->doctor->name) . '</span><br>
                <span class="text--small badge badge--success">' . trans('Doctor') . '</span>';
            } elseif ($this->site) {
                $html = '<span class="text--small badge badge--info">' . trans('Site') . '</span>';
            }

            return $html;
        });
    }

    public function trashBadge(): Attribute
    {
        return new Attribute(function () {
            $html = '';
            if ($this->delete_by_admin) {
                $html = '<span class="text--small badge badge--primary">' . trans('Admin') . '</span>';
            } elseif ($this->delete_by_staff) {
                $html = '<span>' . trans($this->deletedByStaff->name) . '</span><br>
                <span class="text--small badge badge--dark">' . trans('Staff') . '</span>';
            } elseif ($this->delete_by_assistant) {
                $html = '<span>' . trans($this->deletedByAssistant->name) . '</span><br>
                <span class="text--small badge badge--success">' . trans('Assistant') . '</span>';
            } elseif ($this->delete_by_doctor) {
                $html = '<span>' . trans($this->deletedByDoctor->name) . '</span><br>
                <span class="text--small badge badge--info">' . trans('Doctor') . '</span>';
            }

            return $html;
        });
    }
}


