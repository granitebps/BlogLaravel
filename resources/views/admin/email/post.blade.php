<img src="http://localhost:8000/storage/images/posts/{{$post->featured}}" alt="">
<h1>Post Title : {{$post->post_title}}</h1>
<p>{{$post->post_content}}</p>
Link To Post <a href="http://localhost:8000/{{$post->post_slug}}">{{$post->post_title}}</a>