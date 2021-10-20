<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_emp',
        'name_th',
        'name_en',
        'nickname',
        'ipphone',
        'mobile',
        'email',
        'position',
        'team',
        'department',
        'group',
        'location'

    ];
}
