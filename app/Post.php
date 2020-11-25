<?php

namespace App;

use Cocur\Slugify\SlugifyInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable, Notifiable;


    public function sluggable() : array
    {
        return [
            'slug' => [
                'source'   => 'tittle',
                'onUpdate' => true,
            ]
        ];
    }

    protected $fillable = [
        'user_id', 'tittle', 'category_id', 'content','thumbnail_path', 'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    protected $dispatchesEvent = [
         'created' => PostCreated::class,
         'updated' => PostUpdated::class,
         'deleted' => PostDeleted::class,
    ];

}
