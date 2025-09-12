<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    /** @use HasFactory<\Database\Factories\Admin\PortFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function dockings()
    {
        return $this->hasMany(Docking::class);
    }
}
