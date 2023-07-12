<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentExperience extends Model
{
    use HasFactory;
    protected $fillable=[
        'organisation',
        'position',
        'workNature',
        'startDate',
        'endDate',
    ];
}
