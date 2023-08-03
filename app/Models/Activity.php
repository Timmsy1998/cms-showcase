<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['action', 'description', 'user_id', 'model_type', 'model_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
