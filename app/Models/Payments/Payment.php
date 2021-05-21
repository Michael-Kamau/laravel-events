<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function paymentable()
    {
        return $this->morphTo();
    }
}
