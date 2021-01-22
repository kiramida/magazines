<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Magazine;
use App\Author;
use App\Http\Requests\StoreAuthor;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //$message = NULL
    {
        return view('authors', [
            'authors' => Author::orderBy('surname')->with('magazines')->get(),
            ]);
    }

    /**
     * Create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreAuthor $request)
    {
        $author = new Author;
        $author->name = $request->name['new'];
        $author->surname = $request->surname['new'];
        $author->patronymic = $request->patronymic['new']; 
        
        $author->save();
        
        $message = 'Вы успешно добавили автора';
        
        return back()->with('status', $message);
        
        $validated = $request->validated();
    }    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAuthor $request, $id)
    {
        $author = Author::find($id);
        $author->name = $request->name[$id];
        $author->surname = $request->surname[$id];
        $author->patronymic = $request->patronymic[$id]; 
        
        $author->save();
        $message = 'Вы успешно отредактировали автора';
        //$message = var_export($request->name[$id], true);
        return redirect('/authors')->with('status', $message);
        
        $validated = $request->validated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        $author->magazines()->detach();
        Author::destroy($id);
        $message = 'Вы успешно удалили автора';
        
        return back()->with('status', $message);        
    }
}
