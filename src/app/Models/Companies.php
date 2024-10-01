<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Companies extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'phone',
        'social_link'
    ];

    /**
     * Get the employees associated with the company.
     *
     * @return BelongsTo
     */
    public function employees(): BelongsTo
    {
        return $this->belongsTo(Employees::class);
    }
}
