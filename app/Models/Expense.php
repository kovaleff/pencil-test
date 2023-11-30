<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Expense extends Model
{
    use HasFactory;
    public $fillable = [
        'summ',
        'comment'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating( function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
