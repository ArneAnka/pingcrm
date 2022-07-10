<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    use HasFactory;

    protected $table = 'ip_user';

    protected $fillable = ['address', 'agent'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
