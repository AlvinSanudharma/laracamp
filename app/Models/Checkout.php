<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'camp_id',
        'card_number',
        'expired',
        'cvc',
        'is_paid'
    ];

    protected function expired(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => date('Y-m-t', strtotime($value))
        );
    }
    
    public function Camp()
    {
        return $this->belongsTo(Camp::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
