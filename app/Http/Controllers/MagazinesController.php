<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Magazine;
use App\Author;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreMagazine;

class MagazinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //$message = NULL
    {
        $all_magazines = Magazine::with('authors')->get();
        $all_authors = Author::orderBy('surname')->get();
        return view('magazines', [
            'magazines' => $all_magazines,
            'all_authors' => $all_authors    
            ]);
    }

    /**
     * Create a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreMagazine $request)
    {
        $magazine = new Magazine;
        $magazine->name = $request->name;
        $magazine->short_description = $request->short_description;
        $magazine->issue_date = $request->issue_date;
        
        if(!empty($request->image)) {
            $uniq_dir = '/images/'.(Str::random(10));
            $magazine->image = $request->image->store($uniq_dir, 'public');
        }
        
        $magazine->save();
        
        $magazine->authors()->attach($request->authors);
        $message = 'Вы успешно добавили журнал';
        
        return back()->with('status', $message);
        
        $validated = $request->validated();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $magazine = Magazine::find($id);
        $all_authors = Author::orderBy('surname')->get();
        return view('updateMagazineForm', [
            'magazine' => $magazine,
            'all_authors' => $all_authors    
            ]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMagazine $request, $id)
    {
        $magazine = Magazine::find($id);
        $magazine->name = $request->name;
        $magazine->short_description = $request->short_description;
        $magazine->issue_date = $request->issue_date;
        if($request->withoutImage === 'yes') {
            if(!empty($magazine->image) && Storage::disk('public')->exists($magazine->image)) {
                Storage::disk('public')->deleteDirectory(dirname($magazine->image));
            }
            $magazine->image = '';
        } 
        else if(!empty($request->image)) {
            if(!empty($magazine->image) && Storage::disk('public')->exists($magazine->image)) {
                Storage::disk('public')->deleteDirectory(dirname($magazine->image));
            }
            $uniq_dir = '/images/'.(Str::random(10));
            $magazine->image = $request->image->store($uniq_dir, 'public');
        }
        
        $magazine->save();
        
        $magazine->authors()->detach();
        $magazine->authors()->attach($request->authors);
        $message = 'Вы успешно отредактировали журнал';
        
        return redirect('/magazines')->with('status', $message);
        
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
        $magazine = Magazine::find($id);
        $message = "";
        if(Storage::disk('public')->exists($magazine->image)) Storage::disk('public')->deleteDirectory(dirname($magazine->image));
        else $message = 'Файл картинки отсутствует. ';
        
        $magazine->authors()->detach();
        Magazine::destroy($id);
        $message .= 'Вы успешно удалили журнал';
        
        return back()->with('status', $message);        
    }
}
