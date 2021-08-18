<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    const TABLE_NAME = 'dogs';

    const F_NAME = 'name';
    const F_AGE = 'age';
    const F_WEIGHT = 'weight';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::F_NAME,
        self::F_AGE,
        self::F_WEIGHT,
    ];
}
