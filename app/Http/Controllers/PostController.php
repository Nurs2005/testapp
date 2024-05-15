<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\UserPost;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('home', ['posts' => $posts]);
    }

    public function post_list($category_id = null){

        $posts = Post::all();
        if($category_id){
            $posts = Post::where('category_id', $category_id)->get();
        }
        return response()->json([
            'data' => $posts
        ]);
    }

    public function get_categories(){
        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ]);
    }

    public function post_save_api(Request $request){
        $validator = Validator::make($request->all(), [
            'header' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['header' => 'Пустое поле', 'description'  => 'Пустое поле']);
        }

        $user = User::find($request->created_by);
        $post = Post::find($request->id);

        if(!$post){
            $post = new Post();
        }
        $post->header = $request->header;
        $post->description = $request->description;
        $post->created_by = $user->id;
        $post->category_id = $request->category_id;
        $post->save();

        return response()->json([
            'success' => true
        ]);
    }


    public function post_detail($id, $comment_id = null)
    {
        $post = Post::find($id);
        $comments = Comment::all();
        $mycomment = Comment::find($comment_id);

        return view('post_detail', ['post' => $post,'comments' => $comments , 'mycomment' => $mycomment]);
    }


}
