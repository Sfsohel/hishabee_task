<?php

namespace App\Http\Controllers\Expence;

use App\Classes\ExpenceBookRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenceBookRequest;
use App\Models\Expence\ExpenceBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenceBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ExpenceBook::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenceBookRequest $request,ExpenceBookRepository $expenceBook)
    {
        return response($expenceBook->store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expenceBook = ExpenceBook::find($id);
        return $expenceBook;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenceBookRequest $request, $id)
    {
        // return $request->all();
        $expenceBookRepository = new ExpenceBookRepository();
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
        $expenceBook = ExpenceBook::find($id)->delete();
        return response()->json(['messge'=>'Deleted Successfully'],204);
    }
}
