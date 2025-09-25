<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Office extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'office_name',
        'college',
    ];

    /**
     * Get the profiles for the office.
     */
    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
