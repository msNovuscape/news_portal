<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $table = 'advertise';
    protected $fillable = ['title', 'href', 'image', 'views', 'clicks', 'status'];
}
