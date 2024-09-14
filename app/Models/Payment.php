<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'payment_date',
        'payment_method',
        'amount',
        'payment_status',
    ];

   /**
    * Get the transaction that owns the Payment
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function transaction(): BelongsTo
   {
       return $this->belongsTo(Transaction::class);
   }
}
