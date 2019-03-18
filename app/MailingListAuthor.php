<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailingListAuthor extends Model
{
    protected $fillable = ['email', 'display_name'];

    public function messages()
    {
        return $this->hasMany('App\MailingListMessage');
    }

    public function topics()
    {
        return $this->hasMany('App\MailingListTopic');
    }

    public function getGravatarAttribute()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash";
    }
}
