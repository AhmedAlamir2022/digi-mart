<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Purchase extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function transaction() : HasOne
    {
        return $this->hasOne(Transaction::class, 'purchase_id', 'id');
    }

    function purchaseItems() : HasMany
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id');
    }
}
