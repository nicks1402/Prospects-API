<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Prospect extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'phone',
        'email',
        'lead_source',
        'lead_stage',
        'assigned_agent',
        'status',
        'property_type',
        'min_budget',
        'max_budget',
        'location',
        'n_bed',
        'n_bath',
        'property_use',
        'last_contact',
        'next_follow',
        'shortlisted_properties',
        'pre_approved',
        'preferred_move_in_date',
    ];

    protected $casts = [
        'shortlisted_properties' => 'array',
        'pre_approved' => 'boolean',
        'last_contact' => 'date',
        'next_follow' => 'date',
        'preferred_move_in_date' => 'date',
    ];
}

