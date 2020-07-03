<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tracks = Track::join('albums', 'tracks.album_id', 'albums.id')
                        ->join('artists', 'albums.artist_id', 'artists.id')
                        ->orderBy('tracks.id', 'desc')
                        ->select('tracks.id as id', 'tracks.track_name', 'tracks.track_time', 'tracks.track_file', 'albums.album_name', 'artists.artist_name')
                        ->get();

        return view('home', compact('tracks'));
    }
}
