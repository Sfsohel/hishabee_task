<?php

namespace App\Models\Expence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenceBook extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getImageAttribute($value)
    {
        return url('storage/').'/'.$value;
    }
}
