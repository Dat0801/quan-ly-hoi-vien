<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'login_code',
        'card_code',
        'full_name',
        'birth_date',
        'gender',
        'phone',
        'email',
        'avatar',
        'unit_name',
        'unit_position',
        'association_position',
        'term',
        'attendance_permission',
        'club_id',
        'status',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
