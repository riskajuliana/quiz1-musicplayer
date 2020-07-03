@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <img src="{{asset('img/music-background.png')}}" width="100%">
            <div class="card">
                <div class="card-header">
                	Halaman Artist
                	<a href="{{route('artist.create')}}" class="btn btn-sm btn-primary float-right">Tambah</a>
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
                    		<th>Nama Artist</th>
                    		<th>Aksi</th>
                    	</thead>
                    	<tbody>
                    		@foreach($artists as $artist => $art)
                    		<tr>
                    			<td>{{$artist+1}}</td>
                    			<td>{{$art->artist_name}}</td>
                    			<td>
                    				<form action="{{route('artist.destroy', $art->id)}}" method="POST">
                    					<a href="{{route('artist.edit', $art->id)}}" class="btn btn-sm btn-warning">Ubah</a>
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
