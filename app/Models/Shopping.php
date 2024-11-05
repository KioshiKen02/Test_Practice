<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

        protected $fillable = [
        'name',
        'director',
        'poster',
        'price'
    ];
    public function transactions()
    {
    return $this->hasMany(Transaction::class);
    }

}
