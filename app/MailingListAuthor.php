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
}
