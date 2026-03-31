<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    // 1 rola moze ima vise user-a
    // 1 user moze da sadrzi jednu rolu

    public function users()
    {
        $this->hasMany(User::class);
    }

}
