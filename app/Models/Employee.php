<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'employee_id', 'employee_nim', 'employee_name', 'start_date', 'employee_gender', 'employee_address', 'employee_phone'
    ];    
}
