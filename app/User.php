<?php

namespace App;

use Auth;
use Twitter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'twitter_username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get last tweets. Up to 15 for logged user, up to 5 for others.
     */
    public function getTweets()
    {
        if (empty($this->attributes['twitter_username'])) {
            return [];
        }

        $tweets = json_decode(Twitter::getUserTimeline([
            'screen_name' => $this->attributes['twitter_username'],
            'format' => 'json'
        ]), true);

        $keys = array_flip(['id_str', 'text']);
        $tweets = array_map(function($tweet) use ($keys) {
            return array_intersect_key($tweet, $keys);
        }, $tweets);

        $hidden = $this->hiddenContents()->where('type', '=', 'twitter')->pluck('external_id')->toArray();
        if (Auth::check() && Auth::id() === $this->attributes['id']) {
            // Flag hidden tweets and show last 15, to allow the user to manage them
            if (count($hidden) > 0) {
                $tweets = array_map(function($tweet) use($hidden) {
                    if (in_array($tweet['id_str'], $hidden)) {
                        $tweet['hidden'] = true;
                    }
                    return $tweet;
                }, $tweets);
            }
            $amount = 15;
        } else {
            // Remove hidden tweets for other or non-logged users and return only last 5
            if (count($hidden) > 0) {
                $tweets = array_filter($tweets, function($tweet) use($hidden) {
                    return !in_array($tweet['id_str'], $hidden);
                });
            }
            $amount = 5;
        }

        $tweets = array_splice($tweets, 0, $amount);

        return $tweets;
    }

    /**
     * Overwrite route key name for `username` instead of `id`
     * to have more friendly user routes.
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function getPermalinkAttribute()
    {
        return route('user', ['user' => $this]);
    }

    /**
     * Relation with App/Entry. Get the entries of the user.
     */
    public function entries()
    {
        return $this->hasMany('App\Entry');
    }

    /**
     * Relation with App\HiddenContent. Get content to be hidden from user's profile.
     */
    public function hiddenContents()
    {
        return $this->hasMany('App\HiddenContent');
    }
}
