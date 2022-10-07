<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Dateable;

class Task extends Model
{
    use HasFactory, Dateable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
