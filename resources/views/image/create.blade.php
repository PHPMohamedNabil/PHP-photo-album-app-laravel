@extends('layouts.app')

@section('content')

 <div class="container">
 	<div class="row justify-content-center">
 		<div class="col-md-8">
 			<div class="card">
 			   <div class="card-header">
 			        Upload Images of Album	
 			   </div>
 			   <div class="card-body">
 					<image-Upload :album_id="{{$album_id}}"></image-Upload>
 		       </div>
 		    </div>
 		</div>
 		
 	</div>
 </div>


@endsection