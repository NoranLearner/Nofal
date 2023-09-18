<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    public function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    protected $fillable = [
        'title',
        'author',
        'body',
        'cover',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'post_id');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }

}
