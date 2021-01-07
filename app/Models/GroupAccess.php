<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAccess extends Model
{
    use HasFactory;
    protected $table = 'group_access';
    protected $fillable = [
        'user_group_id', 'access_page', 'edit_page'
    ];

    public function UserGroup()
    {
        return $this->belongsTo('App\Models\UserGroup');
    }
}
