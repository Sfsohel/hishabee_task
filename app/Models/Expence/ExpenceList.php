<?php

namespace App\Models\Expence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenceList extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function expenceBook(){
        return $this->belongsTo(ExpenceBook::class,'expence_book_id');
    }
}
