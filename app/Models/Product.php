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
        'description',
        'package_name_whm',
        'price',
        'disk_space_gb',
        'bandwidth_gb',
        'type',
        'has_free_domain',
        'free_domain_tld',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'has_free_domain' => 'boolean', // <-- Tambahkan ini
    ];
}