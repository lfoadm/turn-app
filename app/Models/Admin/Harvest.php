<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    /** @use HasFactory<\Database\Factories\Admin\HarvestFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function dockings()
    {
        return $this->hasMany(Docking::class);
    }
}
