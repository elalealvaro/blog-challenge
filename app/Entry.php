<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_id',
    ];

    /**
     * Accessor for a formatted date.
     */
    public function getCreatedAttribute()
    {
        return $this->created_at->format('H:s M d, Y');
    }

    /**
     * Relation with App\User. Get the author of the entry.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
