<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\Artist;

class AlbumController extends Controller
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
        $albums = Album::join('artists', 'albums.artist_id', 'artists.id')
                            // ->where('albums.artist_id', '=', 'artists.id')
                            ->select('albums.id as id','albums.album_name', 'artists.artist_name')
                            ->orderBy('albums.id', 'DESC')
                            ->get();

        return view('dashboard.album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::all();

        return view('dashboard.album.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Album::create([
            'album_name' => $request->album_name,
            'artist_id' => $request->artist_id
        ]);

        return redirect()->back()->with('sukses', 'Album berhasil di tambah');
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
        $album = Album::where('id', $id)->first();
         $artists = Artist::all();

        return view('dashboard.album.edit', compact('album', 'artists'));
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
        $album = Album::find($id);

        $album->update([
            'album_name' => $request->album_name,
            'artist_id' => $request->artist_id
        ]);

        return redirect()->back()->with('sukses', 'Album berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);

        $album->delete();

        return redirect()->back()->with('sukses', 'Album berhasil dihapus.');
    }
}
