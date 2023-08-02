<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Travel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'travels';

    protected $fillable = [
        'name',
        'description',
        'number_of_days',
        'is_public',
        'slug',
    ];

    public function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attribute) => ($attribute['number_of_days'] - 1)
        );
    }

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }
}
