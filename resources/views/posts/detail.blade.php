@extends('layouts.app')

@section('content')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
 
<div class="container">
  <div class="card mx-auto" style="width: 60%;" >
    <div class="card-body">
     <h4>コメント一覧</h4>

      <div class="card-body">

    @foreach($comments as $comment)
    <div class=" mt-5">

     <div class="card">
      <div class="card-body">
        <h5 class="card-title">  
        <p>{{ $comment['content'] }}</p>
        </h5>
                     <p class="card-text"><small class="text-muted">by {{ $comment->user->name }}</small></p>
                     <p class="card-text">
              <small class="text-muted">   
     </div>
   </div>
</div>    
    @endforeach

    </div>     
<a href="{{ route('posts.show', $comment['post_id']) }}">戻る</a>
</div>     
  </div>
  
</div>

                
@endsection

