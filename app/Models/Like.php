<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id', 'user_id'];

    public function likeable()
    {
        return $this->morphTo(); // ポリモーフィックリレーション
    }
}

