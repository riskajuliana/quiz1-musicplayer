<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use App\Album;

class TrackController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::join('albums', 'tracks.album_id', 'albums.id')
                            ->orderBy('tracks.id', 'DESC')
                            ->select('tracks.id as id',
                                        'tracks.track_name', 
                                        'tracks.track_time', 
                                        'tracks.track_file', 
                                        'albums.album_name')
                            ->get();

        return view('dashboard.lagu.index', compact('tracks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = Album::all();

        return view('dashboard.lagu.create', compact('albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'track_file' => 'required|mimes:mpga'
        ]);

        $file = $request->file('track_file');
        $fileName = $file->getClientOriginalName();
        $eks = explode(".", $fileName)[1];
        $name = uniqid('track_').".".$eks;
        $location = public_path('upload');

        if ($file->move($location, $name)) {
            Track::create([
                'track_name' => $request->track_name,
                'album_id' => $request->album_id,
                'track_time' => $request->track_time,
                'track_file' => $name
            ]);
        }

        return redirect()->back()->with('sukses', 'Lagu berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $track = Track::where('id', $id)->first();
        $albums = Album::all();

        return view('dashboard.lagu.edit', compact('track', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'track_file' => 'mimes:mpga'
        ]);

        if ($request->hasFile('track_file')) {
            $file = $request->file('track_file');
            $fileName = $file->getClientOriginalName();
            $eks = explode(".", $fileName)[1];
            $name = uniqid('track_').".".$eks;
            $location = public_path('upload');

            if ($file->move($location, $name)) {

                $track = Track::where('id', $id)->first();
                $file_lama = $track->track_file;
                $hapus_file_lama = unlink(public_path('upload/'.$file_lama));

                if ($hapus_file_lama) {
                    $update = Track::find($id);
                    $update->update([
                    'track_name' => $request->track_name,
                    'album_id' => $request->album_id,
                    'track_time' => $request->track_time,
                    'track_file' => $name
                    ]);
                }
            }
        }else{
            $update = Track::find($id);
            $update->update([
            'track_name' => $request->track_name,
            'album_id' => $request->album_id,
            'track_time' => $request->track_time,
            ]);
        }

        return redirect()->back()->with('sukses', 'Lagu berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $track = Track::where('id', $id)->first();
        $file_lama = $track->track_file;
        $hapus_file_lama = unlink(public_path('upload/'.$file_lama));

        if ($hapus_file_lama) {
            $hapus = Track::find($id);
            $hapus->delete();
        }

        return redirect()->back()->with('sukses', 'Lagu berhasil dihapus.');
    }
}
