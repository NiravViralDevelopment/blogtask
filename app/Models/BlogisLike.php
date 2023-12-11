<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogisLike extends Model
{
    use HasFactory;
    protected $table = 'blogs_islike';
    protected $fillable = [
        'id',
        'blog_id',
        'user_id',
        'created_at',
        'updated_at',
    ];
    public function blog(){
        return $this->hasMany(Blog::class, 'id');
    }
}
