<?php

namespace App\Http\Controllers\Expence;

use App\Classes\ExpenceListRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenceListRequest;
use App\Models\Expence\ExpenceBook;
use App\Models\Expence\ExpenceList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,ExpenceListRepository $expenceList)
    {
        return response($expenceList->index($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenceListRequest $request,ExpenceListRepository $expenceList)
    {
        return response($expenceList->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expence_list =  ExpenceList::Find($id);
        return $expence_list;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenceListRequest $request, $id)
    {
        $expenceBookRepository = new ExpenceListRepository();
        return response($expenceBookRepository->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expence_list =  ExpenceList::Find($id);
        $expence_book = ExpenceBook::find($expence_list->expence_book_id);
        $expence_book->total_costing -= $expence_list->amount; 
        $expence_book->update(['total_costing'=>$expence_book->total_costing]);
        $expence_list->delete();
        return response()->json(['messge'=>'Deleted Successfully'],204);
    }
}
