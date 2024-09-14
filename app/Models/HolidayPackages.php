<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HolidayPackages extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'duration_days',
        'available_from',
        'available_until',
    ];

    public function getAvailableFromAttribute($value)
    {
        return Carbon::parse($value);
    }
    
    public function getAvailableUntilAttribute($value)
    {
        return Carbon::parse($value);
    }

    /**
     * Get the category that owns the HolidayPackage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    /**
     * Get all of the transaction for the HolidayPackages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'foreign_key', 'local_key');
    }
}
