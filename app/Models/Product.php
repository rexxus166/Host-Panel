<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // TAMBAHKAN INI
    protected $fillable = [
        'name',
        'price',
        'disk_space_gb',
        'bandwidth_gb',
    ];
}