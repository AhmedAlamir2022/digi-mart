<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthorSale extends Model
{
    protected $guarded = [];

    function item() : BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
