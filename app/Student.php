<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    protected $dates = ['birthdate'];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
