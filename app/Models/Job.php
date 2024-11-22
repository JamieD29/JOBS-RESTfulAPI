<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

use MongoDB\Laravel\Eloquent\Model;

class Job extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'jobs';

    protected $fillable = [
        'title',
        'type',
        'description',
        'location',
        'salary',
        'company',
    ];
    // protected $casts = [
    //     'company' => 'array',
    // ];
}
