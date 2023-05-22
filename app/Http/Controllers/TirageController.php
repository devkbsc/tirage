<?php

namespace App\Http\Controllers;

use App\Models\Tirage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TirageController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tirage  $tirage
     * @return \Illuminate\Http\Response
     */
    public function edit(Tirage $tirage)
    {
        return view('tirage.edit', compact('tirage'));
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

        return redirect()->route('tirage.index')->with('success', 'This is the prize gained by this winner');
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
        return redirect()->route('tirage.index')->with('success', 'Tirage is removed from the list');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tirages = Tirage::orderBy('id', 'asc')->paginate(10);

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
        
        $prize = $this->getPrize();
        $rules = [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('tirages', 'email')
            ]
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Redirect back with error messages and old input
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tirage = new Tirage();
        $tirage->name = $request->input('name');
        $tirage->email = $request->input('email');
        $tirage->prize = $prize;
        $tirage->save();
        $tirageid = $tirage->id;
        return redirect()->route('tirage.show', $tirageid)->with('success', 'you have won a ' . $prize);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tirage  $tirage
     * @return \Illuminate\Http\Response
     */
    public function show(Tirage $tirage)
    {
        $prize = $this->getPrize();
        return view('tirage.show', compact('tirage'));
    }

    public function getPrize()
    {
        $prize = " ";
        //$number = $this->shuffleNumber();
        $number = rand(1,100);

        if ($number <= 1) {
            $prize = "tesla";
        } elseif ($number >= 2 && $number <= 10) {
            $prize = "weekend_montagne";
        } elseif ($number >= 11 && $number <= 20) {
            $prize = "ps5";
        } elseif ($number >= 21 && $number <= 50) {
            $prize = "pc_gamer";
        } else {
            $prize = "card_game";
        }

        return $prize;
    }

    
}
