<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Festival;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FestivalEventsController extends Controller
{
    public function index()
    {
        // Get the active festival
        $festival = Festival::where('is_active', 1)->with('events')->first();

        if (!$festival) {
            return response()->json([
                'status' => false,
                'message' => 'No active festival found',
                'data' => []
            ], 404);
        }

        // Convert the festival to an array and prepend 'media/' to the media path
        $festivalArray = $festival->toArray();
        $festivalArray['media'] = 'media/' . $festivalArray['media'];

        // Prepend 'media/' to the image path for each event
        foreach ($festivalArray['events'] as &$event) {
            $event['image'] = 'media/' . $event['image'];
        }

        // Prepare the response data
        $data = [
            'festival' => $festivalArray,
        ];

        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ]);
    }

    public function getTargetEvent($id)
    {
        // Find the event by id and eager load the festival relationship
        $event = Event::with('festival')->find($id);

        if (!$event || !$event->is_active) {
            return response()->json([
                'status' => false,
                'message' => 'Event not found or inactive',
                'data' => []
            ], 404);
        }

        // Convert the event to an array and prepend 'media/' to the image path
        $eventArray = $event->toArray();
        $eventArray['image'] = 'media/' . $eventArray['image'];

        // Convert the related festival to an array and prepend 'media/' to the media path
        if ($event->festival) {
            $festivalArray = $event->festival->toArray();
            $festivalArray['media'] = 'media/' . $festivalArray['media'];
            $eventArray['festival'] = $festivalArray;
        } else {
            $eventArray['festival'] = null;
        }

        // Prepare the response data
        $data = [
            'event' => $eventArray,
        ];

        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ]);
    }

    public function reserve(Request $request, $eventId)
    {
        Log::info('Reserve method called');

        // Check if the user is logged in
        if (!Auth::check()) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $user = Auth::user();
        // Find the event
        $event = Event::find($eventId);
        if (!$event || !$event->is_active) {
            return response()->json([
                'status' => false,
                'message' => 'Event not found or inactive'
            ], 404);
        }

        // Check ticket availability
        $existingReservations = $event->users()->count();
        if ($event->tickets <= $existingReservations) {
            return response()->json([
                'status' => false,
                'message' => 'No tickets available'
            ], 400);
        }

        // Make the reservation
        $event->users()->attach($user->id);

        return response()->json([
            'status' => true,
            'message' => 'تم الحجز بنجاح',
            'data' => [
                'event_name' => $event->ar_title // or $event->en_title depending on the language
            ]
        ], 200);
    }
}
