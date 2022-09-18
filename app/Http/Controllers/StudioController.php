<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudioController extends Controller
{
    //
    public function show($id)
    {
        $studio = Studio::find($id);
        $userId = Auth::id();
        $booking = Booking::find($studio->id);
        if(!$studio)
            abort(404);
        return view('studio-details', [
            'studio' => $studio, 'bookingId' => $booking
        ]);
    }

    public function book(Request $request) {
        $studio = new Studio;
        $studio->name =$request->input('name');
        $studio->description = $request->input('description');
        $studio->image = $request->input('image');
        $studio->start_time = $request->input('start_time');
        $studio->end_time = $request->input('end_time');
        $studio->save();
        return redirect()->back();

    }
}
