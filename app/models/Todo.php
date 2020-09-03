<?php


namespace App\models;


use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'name', 'is_completed'
    ];


}
