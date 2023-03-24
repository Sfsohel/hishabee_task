<?php


namespace App\Classes;

use App\Models\Expence\ExpenceBook;
use App\Models\Expence\ExpenceList;
use Carbon\Carbon;

class ExpenceListRepository
{
    public function index($request)
    {
        $date_from= $request->date_from ? Carbon::parse($request->date_from)->format('Y-m-d 00:00:00') : Carbon::now()->format('Y-m-d 00:00:00');
        $date_to= $request->date_to ? Carbon::parse($request->date_to)->format('Y-m-d 23:59:59') : Carbon::now()->format('Y-m-d 23:59:59');
        $sort = 'created_at';
        $desc = 'asc';
        if ($request->sort=='amount') {
            $sort = 'amount';
        }
        if ($request->desc=='desc') {
            $desc = 'desc';
        }
        $expences =  ExpenceList::with('expenceBook')
                    ->where(function($q) use($request){
                        if ($request->expence_book_id) {
                           $q->where('expence_book_id',$request->expence_book_id);
                        }
                    })
                    ->whereBetween('created_at',[$date_from,$date_to])->orderBy($sort, $desc)->get();
        return $expences;
    }
    public function store($request)
    {
        $expence_book = ExpenceBook::find($request->expence_book_id);
        $expence_book->total_costing += $request->amount; 
        $expence_book->update(['total_costing'=>$expence_book->total_costing]);
        $expence_list =  ExpenceList::create([
            'expence_book_id'=> $request->expence_book_id,
            'amount'=> $request->amount,
            'account_details'=>$request->account_details,
            'remark' => $request->remark
        ]);
        return $expence_list;
    }

    public function update($request, $id)
    {
        $expence_list =  ExpenceList::Find($id);
        $expence_book = ExpenceBook::find($expence_list->expence_book_id);
        $amount = $expence_list->amount - $request->amount; 
        $expence_book->total_costing -= $amount; 
        $expence_book->update(['total_costing'=>$expence_book->total_costing]);
        $expence_list->update([
            'expence_book_id'=> $request->expence_book_id,
            'amount'=> $request->amount,
            'remark' => $request->remark
        ]);
        return $expence_list;
    }
}
