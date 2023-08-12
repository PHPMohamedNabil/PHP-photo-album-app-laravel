@extends('layouts.app')

@section('content')
<style>
    
    .onhover:hover{
        box-shadow: 12px 10px gray;
        display:none
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-12">
        @guest
            @if($background)
               <img src="/storage/{{substr($background,7,strlen($background))}}"  width="100%"/>        
            @endif
        @elseif($background)
        <img src="/storage/{{substr($background,7,strlen($background))}}"  width="100%"/>        
           
        @elseif(!$background && auth()->user()->id == $id)
        <div class="alert alert-warning">
              no Image for album background found ! you can add a new one from profile section
            </div>
        @endguest
        </div>
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
