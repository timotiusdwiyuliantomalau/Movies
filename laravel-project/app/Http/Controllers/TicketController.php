<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
        $validated=$request->validate(['user_id'=>'required','movie_id'=>'required','seat'=>'required','theater'=>'required','price'=>'required','date'=>'required','time'=>'required','total_ticket'=>'required']);
        Ticket::create($validated);
        return response()->json(['Ticket has been bought!']);
        }
        catch(\Exception $e){
            return response()->json(['error'=>$e->getMessage()],400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
