<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'emp_id',
        'month',
        'salary',
        'total_present',
        'total_absent',
        'ba_deduct_day',
        'total_salary',
        'ba_deduct',
        'absent_deduct',
        'gross_salary',
    ];

}
