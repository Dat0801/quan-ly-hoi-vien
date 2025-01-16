<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipTier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'fee',
        'minimum_contribution',
    ];
}