@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <img src="{{asset('img/music-background.png')}}" width="100%">
            <div class="card">
                <div class="card-header">
                	Ubah Album
                	<a href="{{route('album.index')}}" class="btn btn-sm btn-primary float-right">Kembali</a>
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

                	<form action="{{route('album.update', $album->id)}}" method="POST">
                		@csrf
                		@method('PUT')
					  <div class="form-group">
					    <label for="album_name">Nama Album</label>
					    <input type="text" class="form-control" id="album_name" name="album_name" value="{{$album->album_name}}">
					  </div>
					  <div class="form-group">
					    <label for="album_name">Artist</label>
					    <select name="artist_id" class="form-control">
					    	@foreach($artists as $artist)
					    	<option value="{{$artist->id}}" {{($album->artist_id == $artist->id) ? "selected" : ""}}>{{$artist->artist_name}}</option>
					    	@endforeach
					    </select>
					  </div>
					  <button type="submit" class="btn btn-success">Simpan</button>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
