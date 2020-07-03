@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3">
            <img src="{{asset('img/music-background.png')}}" width="100%">
        </div>
        <div class="col-md-10">
            <div class="card">
                <!-- <div class="card-header">Music List</div> -->

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Album</th>
                                <th>Artist</th>
                                <th>Tittle</th>
                                <th>Play</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tracks as $track => $tra)
                            <tr>
                                <td>{{$track+1}}</td>
                                <td>{{$tra->album_name}}</td>
                                <td>{{$tra->artist_name}}</td>
                                <td>{{$tra->track_name}}</td>
                                <td>
                                    <audio controls="controls">
                                        <source src="{{asset('upload/'.$tra->track_file)}}" type="audio/mpeg">
                                    </audio>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
