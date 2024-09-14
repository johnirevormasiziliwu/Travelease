<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get all of the HolidayPackage for the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function HolidayPackage(): HasMany
    {
        return $this->hasMany(HolidayPackages::class);
    }

}
