<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
    use HasFactory;

    protected $fillable = ['floor', 'number', 'block_id'];
    
    public function block()
    {
        return $this->belongsTo(Block::class);
    }
}
