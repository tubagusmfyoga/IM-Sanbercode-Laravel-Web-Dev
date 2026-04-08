<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'age',
        'bio',
        'user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
