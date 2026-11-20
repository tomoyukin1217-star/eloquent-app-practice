<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // 投稿一覧を表示
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();

        return view('posts.index', compact('posts'));
    }

    // 新規投稿画面を表示
    public function create()
    {
        return view('posts.create');
    }

    // 新しい投稿を保存
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        Post::create($validated);

        return redirect()->route('posts.index');
    }

    // 投稿の詳細を表示
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    // 投稿の編集画面を表示
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    // 投稿を更新
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $post = Post::findOrFail($id);

        $post->update($validated);

        return redirect()->route('posts.index');
    }

    // 投稿を削除
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('posts.index');
    }
}
