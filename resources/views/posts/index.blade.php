@extends('layouts.app')

@section('content')

     
    <div class="row justify-content-center">

        <div class="col-md-8">

    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('storage/top6.png')}}" class="d-block w-100" alt="...">
      </div>
</div>
    

                <div class="container py-4" id="skill">
  <p>『育児日記』は全国の皆様と一緒に作るアプリです。</p>

<p>育児の思い出やお悩み「こんな時はどうすればいいの？」「こんな事があって嬉しかった」など,どんなことでも大歓迎！！</p>
 <p>このほかにも、いろいろな記事を募集しています。お見逃しなく！</p>
 <h2>投稿一覧</h2>

  <div class="progress">
      <div class="progress-bar bg-dark" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif     
                    <div class="card-deck">
                      
                      @foreach($posts as $post)
                      <div class="col-md-4 mt-5">

                          <div class="card">
                              <img src="{{ Storage::url($post['image'])}}" class="card-img-top" alt="..."height ="300px;" width="75%"  >
                                <div class="card-body">
                                  <h5 class="card-title">  
                                    <a href="{{ route('posts.show', $post['id']) }}">
                                      <p>{{ $post['title'] }}</p>
                                    </a>
                                  </h5>
   
                                               <p class="card-text"><small class="text-muted">{{$post['created_at']}}</small></p>
                                               
                                               <p class="card-text">
                                        <small class="text-muted">   
                                        <like
                                          :post-id="{{ json_encode($post['id']) }}"
                                          :user-id="{{ json_encode($userAuth->id) }}"
                                          :default-Liked="{{ json_encode(\App\Post::defaultLiked($post, $userAuth->id)) }}"
                                          :default-Count="{{ json_encode(count($post['likes'])) }}"
                                          >
                                        </like>
                                        </small>
                                   </p>

                            </div>
                        
                            </div>

                       </div>    
                      @endforeach
                            </div>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
