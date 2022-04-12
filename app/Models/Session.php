<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'semester',
        'startSetFrom',
        'endSetForm',
        'startAnswer',
        'endAnswer',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'startSetFrom' => 'datetime:d-m-Y',
        'endSetForm' => 'datetime:d-m-Y',
        'startAnswer' => 'datetime:d-m-Y',
        'endAnswer' => 'datetime:d-m-Y',
    ];
}
