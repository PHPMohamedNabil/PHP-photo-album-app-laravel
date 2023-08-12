@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card jumbotron-fluid">
        <h1 class="display-4">{{isset($albums)?'Albums':'User Profiles'}}</h1>
        <p class="lead">
            Results for ({{$title}})
        </p>
    </div>
    <div class="row">
        @if(isset($albums) && count($albums)>0)
        
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

        @elseif(isset($users) && count($users)>0)
            @foreach($users as $user)
                <div class="card col-md-3 mt-3 ml-2" style="border:1px solid #2d2d2d;">
                  <p>
                       <a href="{{route('useralbum',$user->id)}}">
                         <img src="{{Storage::url($user->profile_pic)}}" width="100" height="100" class="img-fluid rounded-circle border border-dark border-3"
                  style="width: 70px;"/>
                       </a>
                          {{$user->name}} <br>
                          <cite>email:{{$user->email}}</cite>
                  </p>
                     <p>
                     @if(isset(auth()->user()->id) && auth()->user()->id !== $user->id)
                      <follow user_id="{{$user->id}}" follows="{{$user->amIfollowing($user->id)}}"></follow>
                     @elseif(isset(auth()->user()->id) && auth()->user()->id == $user->id)
                         <a href="{{route('userprofile',auth()->user()->id)}}" class="btn btn-outline-success">
                                       my profile
                                    </a>
                      @else
                         <a href="/login" style="display:inline-block;" class="btn btn-primary">Follow</a>
                     @endif
                     </p>
                </div>
                        
            @endforeach
       
        @else
          <center>
             <p>
                Search Results for ({{$title}}) not found
             </p>
             <p>
                 <a href="/">Go to homepage and explore more</a>
             </p>
         </center>
        @endif
    </div>
    {!! isset( $albums)?$albums->links():'' !!} 
    {!! isset($users)?$users->links():'' !!} 
</div>
@endsection
