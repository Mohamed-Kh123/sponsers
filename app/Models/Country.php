<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sponser;

class Country extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function sponsers()
    {
        return $this->hasMany(Sponser::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }
}
