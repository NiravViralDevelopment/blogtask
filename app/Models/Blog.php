<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\LikeScope;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'description',
        'image',
        'status',
        'created_at',
        'updated_at',
    ];

    public function likes(){
        return $this->hasMany(BlogisLike::class);
    }

    public function getImageAttribute($value){
        return asset('all_image/'.$value);
    }

    public function scopeAddFavorite($query, $userId = null){
        $andUser = !empty($userId) ? ' AND blogs_islike.user_id = '.$userId : '';
        return $query->addSelect(\DB::raw('(EXISTS (SELECT * FROM blogs_islike WHERE blogs_islike.blog_id = blogs.id'.$andUser.')) as is_like'));
    }



}
