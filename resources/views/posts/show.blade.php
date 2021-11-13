@extends('layouts.app')

@section('content')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
 
<div class="container">
  <div class="card mx-auto" style="width: 60%;" >
    <div class="card-body">
 
    <h2 class="text-center">{{ $post->title }}</h5>

      <img class="d-block mx-auto" src="{{ Storage::url($post->image)}}" height ="auto" width="90%"  >         
        <h5 class="card-text mt-3"> 投稿者：{{ $post->user->name}}</h5>

            <p class="card-text">{{ $post->content }}</p>
      
            <p class="card-text"><small class="text-muted"><like
                    :post-id="{{ json_encode($post->id) }}"
                    :user-id="{{ json_encode($userAuth->id) }}"
                    :default-Liked="{{ json_encode($defaultLiked) }}"
                    :default-Count="{{ json_encode($defaultCount) }}"
                    ></like></small></p>

                    <?php if($post->user_id === Auth::user()->id||Auth::user()->role === 0 ){?>
                    <div class="d-flex col">
                    <a href='/posts/edit/{{ $post->id }}' type="button" class="btn btn-outline-success mx-2"><i class="fas fa-file-download mr-1"></i>データ編集</a>
                    <form  method="POST" action="{{ route('delete', $post->id) }}" >
                        {{ csrf_field() }}
                     <button type="submit" class="btn btn-outline-danger" onSubmit="return checkDelete()"><i class="fas fa-trash-alt mr-1"></i>データ削除</button>
                    </form>
                    </div>
                    <?php
                    }
                    ?>

                      <form  action="{{ route('comments.store') }}" method="post">
                              {{ csrf_field() }}

                       <input name="post_id" type="hidden" value="{{ $post->id }}">
                       
                              <div class="form-group">
                              <label for="exampleFormControlTextarea1">コメント</label>
                              <input class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></input>

                            </div>             
                            
                            
                            <button type="submit" class="btn btn-primary">送信</button>
                </form>
                <div class = "mt-2">
          <a class="mt-5" href="/comment/{{$post->id}}">コメント一覧</a>
          </div>
         </div>
    </div>     
  </div>
  
</div>

                
@endsection

