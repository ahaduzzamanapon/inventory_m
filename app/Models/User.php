<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'date_of_birth',
        'date_of_join',
        'gender',
        'address',
        'phone_number',
        'image',
        'salary',
        'nid',
        'group_id',
        'education',
        'blood_group',
        'religion',
        'marital_status',
        'punch_id',
        'emp_id',
        'experience',
        'email_verified_at',
        'password',
        'remember_token'
    ];
}
