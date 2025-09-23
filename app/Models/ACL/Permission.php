<?php

namespace App\Models\ACL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /** @use HasFactory<\Database\Factories\ACL\PermissionFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function roles()
{
    return $this->belongsToMany(Role::class);
}
}
