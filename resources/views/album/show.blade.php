@extends('layouts.app')

@section('content')
<div class="container">
   <div class="card">
        <div class="card-body">
            <div class="row">
               
            @foreach($albums as $album)
              @if(count($album->albumimages) > 0)
              @foreach($album->albumimages as $img)
                 <div class="col-lg-3 col-md-4 col-6">
                    <a href="{{asset('images')}}/{{$img->image}}" data-lightbox="photos">
                       <img src="{{asset('images')}}/{{$img->image}}" class="img-thumbnail img-responsive" />
                    </a>
                 </div>
              @endforeach
              @else
                <p class="text-center">No Images In This Album RightNow </p>
              @endif
            
            @endforeach
                    
            </div>
        </div>
   </div>
   <div class="col-md-12">
      
   @foreach($albums as $album)
      @if(isset(auth()->user()->id) && auth()->user()->id !== $user_id)
       <follow user_id="{{$user_id}}" follows="{{$follows}}"></follow>
      @endif
     <cite>Author:</cite> <a href="{{route('useralbum',$album->user_id)}}">{{$album->user->name}}</a> 
     
   @endforeach
       <div class="card-body">
           @foreach($albums as $album)
              <p>{{$album->name}}</p>
              <p>{{$album->description}}</p>
           @endforeach
       </div>
   </div>
   <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    
    var disqus_config = function () {
    this.page.url = '{{Request::fullurl()}}';  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://photoalbum-1.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>
@endsection 
