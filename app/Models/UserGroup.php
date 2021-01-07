<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserGroup extends Model
{
    use HasFactory;

    protected $table = 'user_group';

    protected $fillable = array('group_title');
    protected $primaryKey = 'id';

    public function GroupAccess()
    {
        return $this->hasMany('App\Models\GroupAccess');
    }

    public static function getTitle($id)
    {
        $group = UserGroup::where('id', $id)->first();
        if (isset($group->group_title)) {
            $title = $group->group_title;
        } else {
            $title = '';
        }
        return $title;
    }

    public static function checkPermission($page)
    {
        $group_id = Auth::user()->group_id;
        $permission = GroupAccess::where('user_group_id', $group_id)->where('access_page', $page)->count();
        if($permission > 0){
            $data = 0;
        } else {
            $data = 1;
        }
        return $data;
    }

    public static function checkEditPermission($page)
    {
        $group_id = Auth::user()->group_id;
        $permission = GroupAccess::where('user_group_id', $group_id)->where('edit_page', $page)->count();
        if($permission > 0){
            $data = 0;
        } else {
            $data = 1;
        }
        return $data;
    }
}
