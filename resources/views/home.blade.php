@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid">
        <h1 class="display-4">Share Your Photos</h1>
        <p class="lead">
            Share Your Daily Photos make new memories
        </p>
    </div>
    <div class="row">
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
    </div>
    {{$albums->links()}}
</div>
@endsection
