<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeToService extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'service_id',
        'company_id',
    ];

    /**
     * Get the employee associated with the company.
     *
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class);
    }

}
