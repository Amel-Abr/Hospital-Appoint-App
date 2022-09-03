<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $guarded = [ ];
    // protected $table = 'appointments';


    protected $fillable = [
        'patientName',
        'patientphone',
        'patientAddress',
        'patientEmail',
        'doctornName',
        'date',
        'time',
        'patientID',
        'doctorID',

    ];
}
