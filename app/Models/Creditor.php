<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    use HasFactory;

    protected $fillable = ['last_name','first_name', 'gender', 'address', 'phone', 'birth_date','credit_limit'];
}
