<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;
    // 1 contact forma pripada 1 user-u
    // 1 user moze da ima vise contract formi

    protected $fillable = ['title', 'text', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
