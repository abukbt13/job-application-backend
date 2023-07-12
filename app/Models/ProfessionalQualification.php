<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalQualification extends Model
{
    use HasFactory;
    protected $fillable=[
        'institution',
        'level',
        'course',
        'award',
        'startDate',
        'endDate',
    ];
}
