<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use IlluminateSupportFacadesRoute;
use AppHttpControllersPostController;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        // $posts = Post::all();
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $posts = new Post;

        $posts->title = $request->input('title');
        $posts->body = $request->input('body');
    
        // Associando o ID do usuário à chave estrangeira
        $posts->user_id = Auth::id();
    
        // Salvando no banco de dados
        $posts->save();

        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        if (auth()->user()->id == $post->user_id) {
            return view('posts.edit', compact('post'));
        } else {
            // Se o usuário não for o proprietário, redirecione com uma mensagem de erro
            return redirect()->route('posts.index')->with('error', 'Você não tem permissão para excluir este post.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $post = Post::find($id);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        if (auth()->user()->id == $post->user_id) {
            // Deleta o post
            $post->delete();
            return redirect()->route('posts.index')->with('success', 'Post excluído com sucesso.');
        } else {
            // Se o usuário não for o proprietário, redirecione com uma mensagem de erro
            return redirect()->route('posts.index')->with('error', 'Você não tem permissão para excluir este post.');
        }
    }
}
