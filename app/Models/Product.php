<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'name',
        'description',
        'imageCenter',
        'imageLeft',
        'price',
        'point'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
