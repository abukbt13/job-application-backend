<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherCourse extends Model
{
    use HasFactory;
    protected $fillable=[
        'institution',
        'course',
        'certNo',
        'startDate',
        'endDate',
    ];
}
