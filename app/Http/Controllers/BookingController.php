<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    //
    public function create(Request $request) {
        $booking = new Booking;
        $booking->studio_id = $request->input('studio-id');
        $booking->start_time = $request->input('start-time');
        $booking->end_time = date("H:i:s", (strtotime($request->input('end-time')) - 60));

        $exist_bookings = Booking::where('studio_id', $booking->studio_id)->get();
        foreach ($exist_bookings as $exist_booking) {
//            dd($this->between($booking->start_time, $booking->end_time, $exist_booking->start_time));
            if($exist_booking && ($this->between($booking->start_time, $booking->end_time, $exist_booking->start_time) || $this->between($booking->start_time, $booking->end_time, $exist_booking->end_time))) {
                return redirect()->back()->withErrors(['error' => 'Uh-oh! This slot is already booked, please select a different time']);
            }
        }
        if($this->greaterThanOneHour($booking->end_time, $booking->start_time)) {
            return redirect()->back()->withErrors(['error' => 'Please select a slot not greater than one hour']);
        } else {
            $booking->user_id = Auth::id();
            $booking->save();
            return redirect()->back()->with('success', 'Congrats! Your booking is confirmed. Please check email for confirmation');
        }
    }

    private function between($from, $to, $input): bool
    {
        if(strtotime($input) >= strtotime($from) && strtotime($input) <= strtotime($to)) {
            return true;
        }
        return false;
    }

    private function greaterThanOneHour($start, $end): bool
    {
        if(((strtotime($start) - strtotime($end)) > 3600) || ((strtotime($start) - strtotime($end)) < -3600)) {
            return true;
        }
        return false;
    }
}
