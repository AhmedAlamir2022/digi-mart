<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthorWithdrawInformation extends Model
{
    protected $guarded = [];

    function withdrawGateway() : BelongsTo
    {
        return $this->belongsTo(WithdrawMethod::class, 'withdraw_method_id', 'id');
    }
}
