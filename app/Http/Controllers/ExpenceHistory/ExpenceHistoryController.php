<?php

namespace App\Http\Controllers\ExpenceHistory;

use App\Http\Controllers\Controller;
use App\Models\Expence\ExpenceBook;
use Illuminate\Http\Request;

class ExpenceHistoryController extends Controller
{
    public function expenceSummery()
    {
        $expence_books = ExpenceBook::select('id','name','total_costing')->orderBy('total_costing','desc')->get();
        $total_expence = 0;
        $top_expences =[];
        foreach ($expence_books as $key => $expence_book) {
            $total_expence+=$expence_book->total_costing;
            array_push($top_expences,['expence_name'=>$expence_book->name,'costing'=>$expence_book->total_costing,'percentage'=>0]);
        }
        foreach ($top_expences as $key => $top_expence) {
            $top_expences[$key]['percentage']  = round(($top_expence['costing']*100)/$total_expence,2);
        }
        return ["total_expence"=>$total_expence,'top_expence'=>$top_expences];
    }
}
