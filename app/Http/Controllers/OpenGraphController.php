<?php

namespace App\Http\Controllers;

use App\Models\OpenGraph;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Requests\OpenGraphStoreRequest;
use Illuminate\Database\QueryException;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class OpenGraphController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('super-admin')) {
            return view('pages.graph.index');
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
            return view('pages.graph.create',compact('pages'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OpenGraphStoreRequest $request)
    {
        try{
            $formFields = $request->validated();
            $slug = Str::slug($request->title.'_'.Str::random(5));
            OpenGraph::create($formFields+['slug'=>$slug]);
            return redirect()->route('graphs')->with('message','Graph added successfully');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        if (Gate::allows('super-admin')) {
            $pages = Page::all();
            $graph = OpenGraph::whereSlug($slug)->first();
            return view('pages.graph.edit',compact('graph','pages'));
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
            $graph = OpenGraph::whereSlug($slug)->first();
            $formFields = $request->validate([
                'tag_name'=>'required',
                'title'=>'required',
                'description'=>'required',
                'image'=>'required',
                'url'=>'required',
                'type'=>'required',
                'site_name'=>'required',
                'page_id'=>'required|unique:open_graphs,page_id,'.$graph->id,
            ],['page_id.unique'=>'Open graph for this page already exists']);
            $slug = Str::slug($request->title.'_'.Str::random(5));
            $graph->update($formFields+['slug'=>$slug]);
            return redirect()->route('graphs')->with('message','Graph updated successfully');
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
        $graph = OpenGraph::whereSlug($slug)->first();
        $graph->delete();
        return redirect()->route('graphs')->with('message','Graph deleted successfully');
    }
}