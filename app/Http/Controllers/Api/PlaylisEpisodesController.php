<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlayList;
use App\Models\Episode;

class PlaylisEpisodesController extends Controller
{
    public function getPlaylistsAndEpisodes()
    {
        // Get all active playlists with their episodes
        $playlists = PlayList::where('is_active', 1)->withCount(['episodes' => function ($query) {
            $query->where('is_active', 1);
        }])->get();
    
        // Format the playlists
        $playlistsArray = $playlists->toArray();
        foreach ($playlistsArray as &$playlist) {
            $playlist['image'] = 'media/' . $playlist['image'];
        }
    
        // Get all active episodes
        $episodes = Episode::where('is_active', 1)->get();
    
        // Prepare the response data
        $data = [
            'playlists' => $playlistsArray,
            'episodes' => $episodes->toArray(),
        ];
    
        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ]);
    }
    

    public function getEpisodesOfPlaylist($id)
    {
        // Find the playlist by id and eager load the active episodes
        $playlist = PlayList::with(['episodes' => function ($query) {
            $query->where('is_active', 1);
        }])->find($id);

        if (!$playlist || !$playlist->is_active) {
            return response()->json([
                'status' => false,
                'message' => 'Playlist not found or inactive',
                'data' => []
            ], 404);
        }

        // Convert the playlist to an array and prepend 'media/' to the image path
        $playlistArray = $playlist->toArray();
        $playlistArray['image'] = 'media/' . $playlistArray['image'];
        // Extract episodes from the playlist array
        $episodes = $playlistArray['episodes'];
        unset($playlistArray['episodes']);

        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => [
                'playlist' => $playlistArray,
                'episodes' => $episodes
            ]
        ]);
    }

    public function getHomeShowEpisode()
    {
        $episode = Episode::where('home_show', 1)->where('is_active',1)->first();

        if (!$episode) {
            return response()->json([
                'status' => false,
                'message' => 'No episode set to show on home',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Episode retrieved successfully',
            'data' => $episode
        ], 200);
    }
}
