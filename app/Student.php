<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    protected $dates = ['birthdate'];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
