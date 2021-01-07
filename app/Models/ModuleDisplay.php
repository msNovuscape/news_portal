<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleDisplay extends Model
{
    protected $table = 'module_display';

    protected $fillable = array('module_id', 'layout_id', 'position', 'status', 'sort_order' );

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
