<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function getPostCommentsByPostId($post_id){

        $comments = Comment::where('post_id', $post_id)->get();
        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }

    public function saveComment(Request $request){

        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'post_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Bad Request'
            ]);
        }


        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ]);        }

        $post = Post::find($request->post_id);

        $comment = Comment::find($request->id);
        if (!$comment) {
            $comment = new Comment();
        }

        $comment->description = $request->description;
        $comment->user_id = $user->id;
        $comment->post_id = $post->id;
        $comment->save();

        return response()->json(['success' => 'true']);
    }


    public function comment_delete(Request $request){

        $comment = Comment::find($request->id);
        $comment->delete();
        return response()->json(['message' => 'Удалено']);
    }
}
