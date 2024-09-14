<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'price',
    ];

    protected function isRegistered(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => !Auth::check() ? false : Checkout::whereCampId($this->id)->whereUserId(Auth::id())->exists(),
        );
    }
}
