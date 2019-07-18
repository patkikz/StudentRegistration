<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'student_no', 'last_name', 'first_name', 'middle_name', 'gender', 'birthdate', 'address', 'contact', 'added_by'
    ];

    protected $dates = ['birthdate'];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
