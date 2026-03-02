<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function store(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|min:2|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'البيانات غير صالحة',
                'messages' => $validator->errors(),
            ], 422);
        }

        $comment = Comment::create([
            'user_id'  => auth()->id(),
            'event_id' => $event->id,
            'content'     => $request->content,
        ]);

        $comment->load(['user' => function ($q) {
            $q->select('id', 'name');
        }]);

        return response()->json([
            'message' => 'تم إضافة التعليق بنجاح',
            'comment' => $comment,
            'comments_count' => $event->comments()->count(),
        ], 201);
    }

    public function index(Event $event, Request $request)
    {
        $comments = $event->comments()
            ->with(['user' => function ($q) {
                $q->select('id', 'name');
            }])
            ->latest()
            ->paginate(15);

        return response()->json([
            'data'         => $comments->items(),
            'current_page' => $comments->currentPage(),
            'last_page'    => $comments->lastPage(),
            'per_page'     => $comments->perPage(),
            'total'        => $comments->total(),
        ]);
    }


    public function destroy(Comment $comment)
    {
        $user = auth()->user();

        if ($comment->user_id !== $user->id) {
            return response()->json([
                'error' => 'غير مصرح لك بحذف هذا التعليق'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'message' => 'تم حذف التعليق بنجاح',
            'comments_count' => $comment->event->comments()->count(),
        ]);
    }


    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json([
                'error' => 'غير مصرح لك بتعديل هذا التعليق'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'content' => 'required|string|min:2|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'البيانات غير صالحة',
                'messages' => $validator->errors(),
            ], 422);
        }

        $comment->update([
            'content' => $request->content,
        ]);

        $comment->load(['user' => function ($q) {
            $q->select('id', 'name');
        }]);

        return response()->json([
            'message' => 'تم تعديل التعليق بنجاح',
            'comment' => $comment,
        ]);
    }

    public function count(Event $event)
    {
        return response()->json([
            'comments_count' => $event->comments()->count(),
        ]);
    }
}
