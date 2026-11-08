<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = 'films';
    protected $fillable = ['title','sinopsis','year','poster','genre_id'];

    public function kritiks()
    {
        return $this->hasMany(Kritik::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}

