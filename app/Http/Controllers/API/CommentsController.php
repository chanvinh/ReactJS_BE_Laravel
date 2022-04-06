<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index($id)
    {
        $result = Comments::where("medicines_id", $id)->join("users", "users.id", "=", "comments.user_id")->get();
        return $result;
    }

    public function addComments(Request $request)
    {
        $comments = new Comments();
        $comments->user_id = $request->input('user_id');
        $comments->medicines_id = $request->input('medicines_id');
        $comments->text = $request->input('text');
        $comments->image = $request->file('image')->store("comments");
        $comments->save();
        return $comments;
    }
}
