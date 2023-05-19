<?php

namespace App\Http\Controllers;

use App\Models\Tirage;
use Illuminate\Http\Request;

class TirageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tirages = Tirage::orderBy('id','desc')->paginate(5);

        return view('tirage.index', compact('tirages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tirage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        Tirage::create($request->post());

        return redirect()->route('tirage.show')->with('success','you have won a __________.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tirage  $tirage
     * @return \Illuminate\Http\Response
     */
    public function show(Tirage $tirage)
    {
        return view('tirage.show', compact('tirage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tirage  $tirage
     * @return \Illuminate\Http\Response
     */
    public function edit(Tirage $tirage)
    {
        return view('tirage.edit',compact('tirage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tirage  $tirage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tirage $tirage)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $tirage->fill($request->post())->save();

        return redirect()->route('tirage.index')->with('success','This is the prize gained by this winner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tirage  $tirage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tirage $tirage)
    {
        $tirage->delete();
        return redirect()->route('tirage.index')->with('success','Tirage is removed from the list');
    }
}
