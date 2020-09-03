<?php


namespace App\models;


use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title', 'is_completed'
    ];

    public function scopeWithFilters()
    {
        return Todo::when(request()->filled('is_completed'), function ($query) {
            $query->where('is_completed', request()->input('is_completed'));
        })
            ->paginate(10);
    }
}
