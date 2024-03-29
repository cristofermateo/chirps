<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('chirps.index',[
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'message' => ['required', 'min:3']
        ]);
        $message = request('message');

        auth()->user()->chirps()->create([
            'message' => $request->get('message'),

        ]);


        return to_route('chirps.index')
        ->with('status','chirp created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        return view('chirps.edit',[
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {

        if (auth()->user()->isNot($chirp->user)) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => ['required', 'min:3'],
        ]);
        $chirp->update($validated);

        return to_route('chirps.index')
        ->with('status', __('chirp updated susefuli'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
