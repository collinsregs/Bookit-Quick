<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    use HasFactory;
    protected $primaryKey = 'event_Id';
    protected $fillable = [
        'event_Id',
        'event_Name',
        'event_Date',
        'event_Location',
        'description',
        'event_category',
        'max_Attendees',
        'Regular_ticket_price',
        'max_VIP_Attendees',
        'VIP_ticket_price',
        'image',
    ];

}
