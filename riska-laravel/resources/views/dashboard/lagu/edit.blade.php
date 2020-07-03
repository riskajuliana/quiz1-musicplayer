@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <img src="{{asset('img/music-background.png')}}" width="100%">
            <div class="card">
                <div class="card-header">
                	Ubah Lagu
                	<a href="{{route('track.index')}}" class="btn btn-sm btn-primary float-right">Kembali</a>
                </div>

                <div class="card-body">

                	@if(session('sukses'))
                	<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  	{{session('sukses')}}
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					@endif

                	<form action="{{route('track.update', $track->id)}}" method="POST" enctype="multipart/form-data">
                		@csrf
                		@method('PUT')
					  <div class="form-group">
					    <label for="track_name">Judul Lagu</label>
					    <input type="text" class="form-control" id="track_name" name="track_name" value="{{$track->track_name}}">
					  </div>
					  <div class="form-group">
					    <label for="album">Album</label>
					    <select class="form-control" name="album_id">
					    	@foreach($albums as $album)
					    	<option value="{{$album->id}}" {{($track->album_id == $album->id ? "selected" : "")}}>{{$album->album_name}}</option>
					    	@endforeach
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="track_time">Durasi</label>
					    <input type="text" class="form-control" id="track_time" name="track_time" value="{{$track->track_time}}">
					  </div>
					  <div class="form-group">
					    <label for="track_file">File (MP3)</label>
					    <input type="file" class="form-control" id="track_file" name="track_file">
					  </div>
					  <button type="submit" class="btn btn-success">Simpan</button>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
