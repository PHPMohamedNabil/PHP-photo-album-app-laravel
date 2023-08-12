@extends('layouts.app')

@section('content')

 <div class="container">
    <ol class="breadcrumb">
        <h3>Your Album</h3>
        <span style="margin-left:700px;">
            <a href="{{route('album_create')}}" class="btn btn-primary">
                Create New Album
            </a>
            
        </span>
    </ol>
 	<div class="row justify-content-center">
 		<div class="col-12">
 			<div class="card">
 			   <div class="card-header">
 			        All Albums	
 			   </div>
 			   <div class="card-body">
 					<album-Index></album-Index>
 		       </div>
 		    </div>
 		</div>
 		
 	</div>
 </div>


@endsection