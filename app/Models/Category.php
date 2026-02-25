<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $guarded = [];

    protected $casts = [
        'file_types' => 'array'
    ];

    function subCategories() : HasMany
    {
        return $this->hasMany(SubCategory::class);
    }

    function items() : HasMany
    {
        return $this->hasMany(Item::class, 'category_id', 'id');
    }
}
