<?php

namespace App\Http\Controllers;

use App\Tasa;
use Illuminate\Http\Request;

class TasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
      $tasas = Tasa::all();
      return view('tasas.index',compact('tasas'));
    }
    public function getDolar() {
      $tasa = Tasa::all()->last();
      $dolar = $tasa->tasa;
    	return $dolar;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tasa  $tasa
     * @return \Illuminate\Http\Response
     */
    public function show(Tasa $tasa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tasa  $tasa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasa $tasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tasa  $tasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasa $tasa)
    {
        //
    }
    public function editTasa(Request $request)
    {
        $this->validate($request, [
            'tasa' => 'required|max:255',
        ]);

        $tasa = Tasa::find($request->get('id'));
        $tasa->tasa = $request->get('tasa');
        $tasa->save();

        $message = trans('core.changes_saved');
        return redirect()->back()->withSuccess($message);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tasa  $tasa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasa $tasa)
    {
        //
    }
}
