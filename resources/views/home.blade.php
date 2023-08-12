@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset(auth()->user()->id))
      @if(isset($albums) &&  count($albums)<1) 
         <p class="lead text-center">
           
              No News or update from your followers till now.
         
        </p>
      @else

      @endif
    @else
    <div class="jumbotron jumbotron-fluid">
        <h1 class="display-4">Share Your Photos</h1>
        <p class="lead">
            Share Your Daily Photos make new memories.
        </p>
  
    </div>
   @endif
    <div class="row d-flex justify-content-center">
     @if(isset(auth()->user()->id))
        
        @if(isset($albums) && count($albums)>0)
             @foreach($albums as $album)
                 <div class="col-md-6">
                    <div class="card">
                        <div class="d-flex justify-content-between p-2 px-3">
                            <div class="d-flex flex-row align-items-center">
                                <img src="{{Storage::url($album->user->profile_pic)}}" width="100"/>
                                <div class="d-flex flex-column ml-2"> <span class="font-weight-bold"><a href="{{route('useralbum',$album->user->id)}}">{{$album->user->name}}</a></span> <small class="text-primary">{{$album->name}}</small> </div>
                            </div>
                            <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">{{$album->created_at}}</small> <i class="fa fa-ellipsis-h"></i> </div>
                        </div> <img src="{{asset('album')}}/{{$album->image}}" class="card-img-top img-fluid" width="300" height="200"/>
                    </div>
                 </div>
            @endforeach           

        @endif

      @else
        @foreach($albums as $album)
                <div class="col-lg-3 mt-2">
                   
                    <div class="card onhover">
                       <a href="{{route('viewalbum',[$album->slug,$album->id])}}">
                        <img src="{{asset('album')}}/{{$album->image}}" class="card-img-top " width="300" height="200"/>
                       </a>
                        <div class="card-body">
                         <h5 class="card-title"><center>{{$album->name}}</center></h5>
                        </div>
                    </div>
                 
                </div>
       @endforeach
      @endif

    </div>
    {!! $albums->links() !!}
</div>
@endsection
