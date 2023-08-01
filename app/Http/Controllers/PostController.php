<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->latest()->get();

        return view('user_custom_dashboard.crud.all', [
            'title' => "All Posts",
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_custom_dashboard.crud.create', [
            'title' => "Create Post",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image|max:2048',
        ]);

        Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'body' => $request->body,
            'photo_path' => isset($request->image) ? $this->storeImage($request) : null,
        ]);

        return redirect()->back()->with('success', "Post create successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        }

        $comments = Comment::where('post_id', $post->id)->latest()->get();


        return view('user_custom_dashboard.crud.show', [
            'title' => "Show Post",
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        }

        return view('user_custom_dashboard.crud.edit', [
            'title' => "Edit Post",
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image|max:2048',
        ]);

        $post = Post::findOrFail($request->id);

        if ($post->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        }

        // remove old image
        if (isset($request->image) && $post->photo_path) {
            $imagePath = public_path('storage/' . $post->photo_path);
            if (File::exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'photo_path' => isset($request->image) ? $this->storeImage($request) : $post->photo_path,
        ]);

        return redirect()->back()->with('success', "Post updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $post = Post::onlyTrashed()
            ->where('id', $request->id)
            ->get();

        $post = $post[0];

        if ($post->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        }

        $imagePath = public_path('storage/' . $post->photo_path);
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }

        $post->forceDelete();
        return redirect()->back()->with('success', "Post has been permanently deleted");
    }


    /**
     * custom code below
     */

    private function storeImage($request)
    {
        $name = now()->timestamp . "_{$request->image->getClientOriginalName()}";
        $path = $request->file('image')->storeAs('post_uploads', $name, 'public');

        return $path;
    }

    // soft deletes only
    public function delete(Request $request)
    {
        $post = Post::findOrFail($request->id);

        if ($post->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        }

        $post->delete();
        return redirect()->back()->with('success', "Post has been deleted");
    }

    public function trash()
    {
        $posts = DB::table('posts')
            ->where('deleted_at', '<>', null)
            ->where('user_id', '=', Auth::user()->id)
            ->latest('deleted_at')->get();

        return view('user_custom_dashboard.crud.trash', [
            'title' => "Trash",
            'posts' => $posts,
        ]);
    }

    public function restore(Request $request){
        $post = Post::onlyTrashed()
            ->where('id', $request->id)
            ->get();

        $post = $post[0];

        if ($post->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        }

        $post->restore();
        return redirect()->back()->with('success', "Post has been restore");
    }
}
