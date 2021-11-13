@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">投稿フォーム</div>

              


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form enctype="multipart/form-data"  action="{{ route('posts.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <div class="form-group">

<label for="exampleFormControlTextarea1">子育てに関する思い出や、悩みなどを是非お聞かせください！</label>
</div>

                        <label for="exampleFormControlTextarea1">タイトル</label>


                        <input class="form-control" id="exampleFormControlTextarea1" rows="3" name="title">

                      </div>                      

                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">ファイル</label>

                          <div class="form-image_url">
                            <input id= "image" type="file" name="image" accept="image/jpeg,image/png"> 
                          </div>
                      </div>          
                      <div class="form-group">
           
                      
                      </div>
                      <div class="form-group">
                      


                      <label for="exampleFormControlTextarea1">本文</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
                    </div>


                      <button type="submit" class="btn btn-primary">送信</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
