<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigurationFrontpage extends Model
{
    use HasFactory;
    protected $fillable = ['configuration', 'size'];
}
