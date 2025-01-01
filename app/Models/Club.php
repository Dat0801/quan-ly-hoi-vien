<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    protected $fillable = [
        'club_code',
        'name_vi',
        'name_en',
        'name_abbr',
        'address',
        'tax_code',
        'phone',
        'email',
        'website',
        'fanpage',
        'established_date',
        'established_decision',
        'industry_id',
        'field_id',
        'market_id',
        'connector_id',
        'status',
    ];

     public function industry()
     {
         return $this->belongsTo(Industry::class);
     }
 
     public function field()
     {
         return $this->belongsTo(Field::class);
     }
 
     public function market()
     {
         return $this->belongsTo(Market::class);
     }
 
     public function connector()
     {
         return $this->hasMany(Connector::class);
     }
}