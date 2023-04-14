<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    use HasFactory;

    protected $primaryKey = 'positions_id';

    protected $fillable = [
        'positions_id', 'positions_title', 'positions_division'
    ];  
}
