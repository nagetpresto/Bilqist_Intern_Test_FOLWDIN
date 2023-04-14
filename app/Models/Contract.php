<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    public function position()
    {
        return $this->belongsTo(Positions::class, 'positions_id', 'positions_id');
    }

    protected $fillable = [
        'employee_id', 'positions_id', 'status',
    ];
}
