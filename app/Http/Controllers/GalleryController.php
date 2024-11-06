<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $data = array(
            'id' => 'posts',
            'menu' => 'Gallery',
            'galleries' => Post::where('picture', '!=', '')
                                ->whereNotNull('picture')
                                ->orderBy('created_at', 'desc')
                                ->paginate(30)
        );
        return view('gallery.index') -> with ($data);
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);
    
        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid() . '_' . time();
    
            $smallFilename = "small_{$basename}.{$extension}";
            $mediumFilename = "medium_{$basename}.{$extension}";
            $largeFilename = "large_{$basename}.{$extension}";
            $filenameSimpan = "{$basename}.{$extension}";
    
            $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);
        } else {
            $filenameSimpan = 'noimage.png';
        }
    
        $post = new Post;
        $post->picture = $filenameSimpan;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
    
        return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $gallery = Post::findOrFail($id);
        return view('gallery.edit', compact('gallery'));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);
    
        // Cari data berdasarkan ID
        $gallery = Post::findOrFail($id);
    
        // Proses file gambar baru jika ada
        if ($request->hasFile('picture')) {
            // Hapus gambar lama dari storage jika bukan gambar default
            if ($gallery->picture != 'noimage.png') {
                Storage::delete('posts_image/' . $gallery->picture);
            }
    
            // Simpan gambar baru
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid() . '_' . time();
    
            $filenameSimpan = "{$basename}.{$extension}";
            $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);
    
            // Update field gambar di database
            $gallery->picture = $filenameSimpan;
        }
    
        // Update field lain
        $gallery->title = $request->input('title');
        $gallery->description = $request->input('description');
    
        // Simpan perubahan
        $gallery->save();
    
        return redirect('gallery')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $gallery = Post::findOrFail($id);

        // Hapus gambar dari storage jika bukan gambar default
        if ($gallery->picture != 'noimage.png') {
            Storage::delete('posts_image/' . $gallery->picture);
        }

        // Hapus data dari database
        $gallery->delete();

        return redirect('gallery')->with('success', 'Gambar berhasil dihapus');
    }
}