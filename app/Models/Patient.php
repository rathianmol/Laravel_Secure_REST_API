<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'email',
        'phone',
        'ssn',
        'street',
        'city',
        'state',
        'zip_code',
        'case_description',
        'food_allergies',
        'medicine_allergies',
        'insect_allergies',
        'other_allergies',
        'previous_illnesses',
        'current_illnesses',
        'physical_disabilities',
        'respitory_condition',
        'heart_condition',
        'hearing_condition',
        'visual_condition',
        'siezures',
        'current_medications',
    ];
}
