<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reset_password_tokens extends Model
{
    use HasFactory;
    protected $fillable=['token'];
}
