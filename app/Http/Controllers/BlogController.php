<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        $blogs = Blog::with('comments')->get();
        return view('blogs.index', compact('blogs'));
           
  
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }
    
        Blog::create([
            'title' => $request->title,
            'image' => 'uploads/'.$imageName, // Save image path
            'description' => $request->description,
        ]);
    
        return redirect('/view')->with('success', 'Blog created successfully');
    }
     // Show the edit form
     public function edit($id)
     {
         $blog = Blog::findOrFail($id);
         return view('blogs.edit', compact('blog'));
     }
      // Update the blog
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update($request->all());

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }
    // Delete a blog
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
    
}

