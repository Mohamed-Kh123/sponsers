<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Sponser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'country_id', 'phone2', 'email', 'password', 'responsible_name','city_id',
        'telephone', 'nationality', 'ident_type', 'identifier','phone','address', 'type'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function beneficiaries()
    {
        return $this->hasMany(Beneficiaries::class, 'sponser_id');
    }
}
