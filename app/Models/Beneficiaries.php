<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiaries extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'sponser_id', 'name',
    ];



    public function sponser()
    {
        return $this->belongsTo(Sponser::class, 'sponser_id');
    }



    
}
