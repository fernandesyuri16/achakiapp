<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the employees for the service.
     *
     * @return HasMany
     */
    public function employee(): HasMany
    {
        return $this->hasMany(Employees::class);
    }
}
