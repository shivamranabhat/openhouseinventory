<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TagStoreRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('super-admin')) {
            return view('pages.tags.index');
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
            $pages = Page::select('id','name')->get();
            return view('pages.tags.create',compact('pages'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request)
    {
        try{
            $formFields = $request->validated();
            $page = Page::whereId($request->page_id)->first();
            $slug = Str::slug($page->name);
            Tag::create($formFields+['slug'=>$slug]);
            return redirect()->route('tags')->with('message','Tags added successfully');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        if (Gate::allows('super-admin')) {
            $tag = Tag::whereSlug($slug)->first();
            return view('pages.tags.details',compact('tag'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        if (Gate::allows('super-admin')) {
            $pages = Page::all();
            $tag = Tag::whereSlug($slug)->first();
            return view('pages.tags.edit',compact('tag','pages'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        try{
            $tag = Tag::whereSlug($slug)->first();
            $formFields = $request->validate([
                'tag_name'=>'required',
                'title'=>'required',
                'meta_description'=>'required',
                'meta_keywords'=>'required',
                'canonical_tag'=>'nullable',
                'page_id'=>'required|unique:tags,page_id,'.$tag->id,
            ]
            ,[
                'page_id.unique'=>'Tags for this page already exists'
            ]
        );
            $page = Page::whereId($request->page_id)->first();
            $slug = Str::slug($page->name);
            $tag->update($formFields+['slug'=>$slug]);
            return redirect()->route('tags')->with('message','Tags updated successfully');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $tag = Tag::whereSlug($slug)->first();
        $tag->delete();
        return redirect()->route('tags')->with('message','Tags deleted successfully');
    }
}
