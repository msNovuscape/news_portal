<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    protected $table ='layout';
    protected $fillable = ['layout_title', 'layout_route'];
}
