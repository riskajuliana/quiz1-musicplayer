@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <img src="{{asset('img/music-background.png')}}" width="100%">
            <div class="card">
                <div class="card-header">
                	Halaman Lagu
                	<a href="{{route('track.create')}}" class="btn btn-sm btn-primary float-right">Tambah</a>
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

                    <table class="table">
                    	<thead>
                    		<th>No</th>
                    		<th>Judul Lagu</th>
                    		<th>Album</th>
                    		<th>Durasi</th>
                    		<th>Putar</th>
                    		<th>Aksi</th>
                    	</thead>
                    	<tbody>
                    		@foreach($tracks as $track => $tra)
                    		<tr>
                    			<td>{{$track+1}}</td>
                    			<td>{{$tra->track_name}}</td>
                    			<td>{{$tra->album_name}}</td>
                    			<td>{{$tra->track_time}}</td>
                    			<td>
                                    <audio controls>
                                        <source src="{{asset('upload/'.$tra->track_file)}}" type="audio/mpeg">
                                    </audio>         
                                </td>
                    			<td>
                    				<form action="{{route('track.destroy', $tra->id)}}" method="POST">
                    					<a href="{{route('track.edit', $tra->id)}}" class="btn btn-sm btn-warning">Ubah</a>
                    						@csrf
                    						@method('DELETE')
                    					<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    				</form>
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
