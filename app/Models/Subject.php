<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function stacks()
    {
        return $this->hasMany(Stack::class);
    }
}
