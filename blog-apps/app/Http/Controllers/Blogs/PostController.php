<?php

namespace App\Http\Controllers\Blogs;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('posts.index', ['posts' => Post::latest()->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'title' => 'required',
            'content' => 'required'
        ]);
        // upload image
        $request->file('image')->storeAs('public/post', $request->file('image')->hashName());

        $posting = Post::create([
            'image' => $request->file('image')->hashName(),
            'title' => $request->title,
            'content' => $request->content
        ]);
        if ($posting) {
            # code...
            return redirect()->route('posts.index')->with(['success' => 'Data berhasil di tambahkan']);
        } else {
            # code...
            return redirect()->route('posts.index')->with(['error' => 'Data gagal di tambahkan']);
        }
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('posts.show',['blog'=>Post::findOrfail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('posts.edit', ['blog' => Post::findOrfail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $posts = Post::find($id);
        if ($request->file('image') == '') {
            $posts->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
        } else {
            Storage::disk('local')->delete('public/posts/' . $posts->image);
            $foto = $request->file('image');
            $foto->storeAs('public/posts/', $foto->hasName());
            $posts->update([
                'image' => $foto->hashName(),
                'title' => $request->title,
                'content' => $request->content
            ]);
            if ($posts) {

                //redirect dengan pesan sukses
                return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diupdate!']);
            } else {
                //redirect dengan pesan error
                return redirect()->route('posts.index')->with(['error' => 'Data Gagal Diupdate!']);
            }
        }
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
        $delete = Post::findOrFail($id);
        Storage::disk('local')->delete('public/post/' . $delete->image);
        $delete->delete();
        if ($delete) {
            # code...
            return redirect()->route('posts.index')->with(['success' => 'Data berhasil di hapus']);
        } else {
            # code...
            return redirect()->route('posts.index')->with(['error' => 'Data gagal di hapus']);
        }
    }
}
