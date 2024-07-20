<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Festival;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\Branch;
class FestivalController extends Controller
{
        
    public function index()
    {
        // Fetch active festivals and events
        $festival = Festival::where('is_active', 1)->get();
        $events = Event::where('is_active', 1)->get();

        // Prepare the data with formatted dates and time differences
        $events = $events->map(function ($event) {
            $eventDate = Carbon::parse($event->date);
            $currentDate = Carbon::now();

            // Calculate the difference
            $diffInHours = $currentDate->diffInHours($eventDate);
            $diffInMinutes = $currentDate->diffInMinutes($eventDate) % 60;

            // Format the date
            $formattedDate = $eventDate->format('d F Y'); // e.g., 30 June 2024

            // Add formatted data to the event object
            $event->diffInHours = $diffInHours;
            $event->diffInMinutes = $diffInMinutes;
            $event->formattedDate = $formattedDate;

            return $event;
        });

        return view('front.event', compact('festival', 'events'));
    }
    public function event($id)
    {
        $event=Event::find($id);
        return view('front.concert',compact('event'));
    }

    public function branch($id)
    {
        $target_branch= Branch::find($id);
        $branches = Branch::where('is_active', 1)->where('event_id',$target_branch->event_id)->get();
        return view('front.branch',compact('branches','target_branch'));
    }
}
