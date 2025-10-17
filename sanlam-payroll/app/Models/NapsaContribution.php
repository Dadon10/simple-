<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NapsaContribution extends Model
{
    protected $fillable = [
        'employee_id',
        'month',
        'employee_contrib',
        'employer_contrib',
        'total_contrib',
        'reconciled',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
