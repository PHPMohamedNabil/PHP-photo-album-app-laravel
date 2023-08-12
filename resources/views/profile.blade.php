@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <div class="col-md-12">
         <div class="card">
           <div class="card-header">
               Manage profile
           </div>
           <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              
              <li class="nav-item active" role="presentation">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#Following" role="tab" aria-controls="profile" aria-selected="false">Following</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="contact" aria-selected="false">Profile Picture</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#background" role="tab" aria-controls="home" aria-selected="true">Background</a>
              </li>
            </ul>
             <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
               <div class="tab-pane fade show active" id="Following" role="tabpanel" aria-labelledby="profile-tab">
                   @foreach($followers as $follower)
                     <p>
                         {{$follower->userfollow->name}}
                     <a href="{{route('useralbum',$follower->userfollow->id)}}">
                         <img src="{{Storage::url($follower->userfollow->profile_pic)}}" width="100"/>
                     </a>
                     </p>
                     <p>
                     @if(isset(auth()->user()->id) && auth()->user()->id !== $user_id)
                      <follow user_id="{{$user_id}}" follows="{{$follows}}"></follow>
                     @endif
                     </p>
                        
                   @endforeach

               </div>
               <div class="tab-pane fade" id="background" role="tabpanel" aria-labelledby="contact-tab">
               <background userdata="{{auth()->user()->id}}"></background>
               </div>
               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="contact-tab">
               <avatar userdata="{{auth()->user()->id}}"></avatar>
               </div>
               
                    
              </div>

           </div>
         </div>
       </div>
    </div>
        
 
</div>
@endsection