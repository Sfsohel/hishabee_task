<?php


namespace App\Classes;

use App\Models\Expence\ExpenceBook;

class ExpenceBookRepository
{
    public function store($request)
    {
        // return $request->all();
        $image_path = $request->file('image')->store('image', 'public');
        return ExpenceBook::create([
            'name' => $request->name,
            'image' => $image_path
        ]);
    }

    public function update($request, $id)
    {
        $expenceBook = ExpenceBook::find($id);
        $image_path = $request->file('image')->store('image', 'public');
        $expenceBook->update([
            'name' => $request->name,
            'image' => $image_path
        ]);
        return $expenceBook;
    }
}
