<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    /** @use HasFactory<\Database\Factories\Admin\ReasonFactory> */
    use HasFactory;

    protected $fillable = ['title', 'purge'];

    // public function stop()
    // {
    //     return $this->belongsTo(Stop::class);
    // }
}
