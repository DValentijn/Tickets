<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    // app/Http/Controllers/CommentController.php

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'nullable|string',
            'ticket_id' => 'required|integer|exists:tickets,id',
            'image' => 'nullable|image|max:2048', // Example validation
        ]);



// Check if both body and image are absent
if (empty($request->body) && !$request->hasFile('image')) {
    return back()->withErrors(['message' => 'A comment must contain either text or an image.']);
}


        $imagePath = null;
        if ($request->hasFile('image')) {

            $file = $request->file('image'); // Retrieve the uploaded file from the request
            $filename = $file->getClientOriginalName(); // Retrieve the original filename
            $path = 'public/comments' . $filename;

            Storage::disk('local')->put($path, file_get_contents($file));

            $imagePath = $path;
            // $imagePath = $request->file('image')->store('public/comments');
        }

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->ticket_id = $request->ticket_id;
        $comment->user_id = auth()->id();
        $comment->image_path = $imagePath;
        $comment->save();

        return back()->with('success', 'Comment added successfully.');
    }


}

