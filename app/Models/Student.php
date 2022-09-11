<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'LastName',
        'FirstName',
        'City',
        'State',
        'Country',
        'Gender',
        'StudentStatus',
        'Major',
        'Age',
        'SAT',
        'Grade',
        'Height',
    ];
    
    use HasFactory;
}
