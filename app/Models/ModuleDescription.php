<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleDescription extends Model
{
    protected $table = 'module_description';

    protected $fillable = array('module_id', 'language_id', 'title' );

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
