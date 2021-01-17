<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['article_id','name','email','parent_id','comment','status'];

    function article()
    {
        return $this->belongsTo(Article::class);
    }
}
