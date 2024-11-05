<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory; // Make sure to include this trait for factory support

    protected $fillable = ['user_id', 'shopping_id', 'total', 'status'];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Shopping model (if applicable)
    public function shopping()
    {
        return $this->belongsTo(Shopping::class);
    }
}