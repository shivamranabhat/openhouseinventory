<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Requests\BlogStoreRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('super-admin')) {
            return view('pages.blog.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('super-admin')) {
            return view('pages.blog.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }

      /**
     * store the images selected in ck editor.
     */
    public function uploadCkImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $uploadedFile = $request->file('upload');
            // Generate a unique file name
            $fileName = $uploadedFile->getClientOriginalName();
            // Move the file to the desired directory
            $uploadedFile->move(public_path('storage/blogs/media'), $fileName);
            // Construct the URL to the uploaded file
            $url = asset('storage/blogs/media/' . $fileName);
            // Return JSON response
            return response()->json(['file' => $fileName, 'uploaded' => 1, 'url' => $url]);
        } else {
            // Handle case when no file is uploaded
            return response()->json(['uploaded' => 0, 'error' => 'No file uploaded']);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $formFields = $request->validate([
                'title'=>'required|unique:blogs,title',
                'author'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,webp',
                'image_alt'=>'required',
                'description' => 'required',
            ]);
    
            // Handle main image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '-' . $image->getClientOriginalName();
                $formFields['image'] = $image->storeAs('blogs/image', $imageName, 'public');
            }
    
            // Generate slug from title
            $slug = Str::slug($formFields['title']);
            
            // Create blog post with the form fields and slug
            $blog = Blog::create($formFields + ['slug' => $slug]);
    
            // Store name to page table if blog creation is successful
            if ($blog) {
                Page::create([
                    'name' => $formFields['title'],
                    'slug' => $slug,
                ]);
            }
    
            return redirect()->route('blogs')->with('message', 'Blog added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Please fill the required fields.');
        }
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $slug)
    {
        if (Gate::allows('super-admin')) {
            $blog = Blog::whereSlug($slug)->first();
            return view('pages.blog.edit',compact('blog'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, String $slug)
    {
        try {
            // Find the blog post by slug
            $blog = Blog::whereSlug($slug)->firstOrFail();
            $page = Page::where('slug', $slug)->first();
    
            // Validate the request
            $formFields = $request->validate([
                'title' => 'required|unique:blogs,title,' . $blog->id,
                'author' => 'required',
                'image_alt' => 'required',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ], [
                'title.unique' => 'Blog with this title already exists'
            ]);
    
            // Handle main image upload
            if ($request->hasFile('image')) {
                if (!empty($blog->image)) {
                    $oldImagePath = public_path('storage/' . $blog->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $uploadedFile = $request->file('image');
                $fileName = time() . '-' . $uploadedFile->getClientOriginalName();
                $mainImagePath = $uploadedFile->storeAs('blogs/image', $fileName, 'public');
                $formFields['image'] = $mainImagePath;
            }
    
    
            // Update the blog post
            $formFields['slug'] = Str::slug($formFields['title']);
            $blog->update($formFields);
    
            // Update the page if it exists
            if ($page) {
                $page->update([
                    'name' => $formFields['title'],
                    'slug' => $formFields['slug'],
                ]);
            }
    
            return redirect()->route('blogs')->with('message', 'Blog updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Please fill the required fields.');
        }
    }

}
