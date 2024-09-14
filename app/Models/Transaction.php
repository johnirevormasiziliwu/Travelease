<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'user_id',
        'holiday_package_id',
        'transaction_date',
        'start_date',
        'end_date',
        'total_price',
        'payment_status',
    ];

   // Accessor untuk format tanggal mulai
   public function getFormattedStartDateAttribute()
   {
       return Carbon::parse($this->start_date)->format('d M Y');
   }

   // Accessor untuk format tanggal akhir
   public function getFormattedEndDateAttribute()
   {
       return Carbon::parse($this->end_date)->format('d M Y');
   }

    public function getDurationInDaysAttribute()
    {
        $startDate = $this->start_date;
        $endDate = $this->end_date;

        // Mengonversi string menjadi objek Carbon
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Menghitung selisih hari
        return $start->diffInDays($end);
    }

    /**
     * Get the user that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the holidayPackage that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function holidayPackage(): BelongsTo
    {
        return $this->belongsTo(HolidayPackages::class);
    }

    /**
     * Get the payment associated with the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'foreign_key', 'local_key');
    }
}
