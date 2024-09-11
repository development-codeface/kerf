<?php

namespace App\Models;

use App\Constants\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{

    public function statusBadge(): Attribute
    {
        return new Attribute(function(){
            $html = '';
            if($this->status == Status::TICKET_OPEN){
                $html = '<span class="badge badge--success">'.trans("Open").'</span>';
            }
            elseif($this->status == Status::TICKET_ANSWER){
                $html = '<span class="badge badge--primary">'.trans("Answered").'</span>';
            }

            elseif($this->status == Status::TICKET_REPLY){
                $html = '<span class="badge badge--warning">'.trans("Customer Reply").'</span>';
            }
            elseif($this->status == Status::TICKET_CLOSE){
                $html = '<span class="badge badge--dark">'.trans("Closed").'</span>';
            }
            return $html;
        });
    }


    public function supportMessage(){
        return $this->hasMany(SupportMessage::class);
    }

}
