<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function getHome()
    {
        $posts=Post::orderBy('created_at', 'desc')->get();
        return view('home', ['posts' => $posts]);
    }
    public function createPost(Request $request)
    {

        $this->validate($request, [
           'body' => 'required'
        ]);
        $post=new Post();

        $post->body=$request['body'];
        $message='There was an error.';
        if($request->user()->posts()->save($post))
        {
            $message= ' Post successfuly created';
        };
        return redirect()->route('home')->with(['message' => $message]);
    }

    public function deletePost($post_id)
    {
        $post=Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user)
        {
            return redirect()->back();
        }

        $post->delete();

        return redirect()->route('home')->with(['msg' => 'Post successfully deleted.']);
    }
    public function editPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post=Post::find($request['postId']);
        $post->body=$request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body], 200);
    }
}