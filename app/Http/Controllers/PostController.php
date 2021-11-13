<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAuth = \Auth::user();

        $posts = Post::all();
        //dd($posts);
        $comments = Comment::all();

        $users = User::find('id');

        $posts->load('likes');

        // likeが多い順にソート
        $posts = $posts->toArray();
   

        $sort = [];
        foreach ($posts as $key => $post) {
            $sort[$key] = $post['likes'];
        }

        array_multisort($sort, SORT_DESC, $posts);

        return view('posts.index', [
            'posts' => $posts,
            'userAuth' => $userAuth,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

    
    $post = new Post;

    $post->content = $request->content;
    $post->title = $request->title;
    $post->user_id = \Auth::user()->id;
    $post->image = $request->file('image');
    if($post->image){
        $filename=request()->file('image')->getClientOriginalName();
        $post['image']=request('image')->storeAs('public/images', $filename);
    }
    $post->save();


    return redirect('/');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $posts = Post::find($post);

        $userAuth = \Auth::user();

        $post->load('likes');



        $defaultCount = count($post->likes);

        $defaultLiked = $post->likes->where('user_id', $userAuth->id)->first();
     

        return view('posts.show', [
            'post' => $post,
            'userAuth' => $userAuth,
            'defaultLiked' => $defaultLiked,
            'defaultCount' => $defaultCount,

        ]);
    }

    /**
     * ブログ編集フォームを表示する
     * @param int $id
     * @return view
     */

    public function showEdit($id)
    {

        $post = Post::find($id);
        $comments = Comment::find($id);
        
        if(is_null($post)){
            \Session::flash('err_msg','データがありません。');
            return redirect('/');
        }
        return view('posts.edit', ['post' => $post]); 
    }
    /**
     * ブログを更新する。
     * @return view
     */
    public function exeUpdate(Request $request)
    {

        $inputs = $request->all();

        $post = Post::find($inputs['id']);
        $post->fill([
            'title' =>$inputs['title'],
            'content' =>$inputs['content'],

        ]);
        if($post->image){
            $filename=request()->file('image')->getClientOriginalName();
            $post['image']=request('image')->storeAs('public/images', $filename);
        }


        $post->user_id = \Auth::user()->id;
       
        $post->save();

        return redirect('/');
    }

    /**
     * ブログを削除する
     * @param int $id
     * @return view
     */

    public function exeDelete($id)
    {

        Post::destroy($id);
      
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
