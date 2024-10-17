<?php

namespace App\Http\Controllers;

use App\Models\TwitterCard;
use Illuminate\Http\Request;
use App\Http\Requests\TwitterCardStoreRequest;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class TwitterCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('super-admin')) {
            return view('pages.twitter.index');
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
            return view('pages.twitter.create',compact('pages'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TwitterCardStoreRequest $request)
    {
        try{
            $formFields = $request->validated();
            $slug = Str::slug($request->title.'_'.Str::random(5));
            TwitterCard::create($formFields+['slug'=>$slug]);
            return redirect()->route('cards')->with('message','Twitter Card added successfully');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        if (Gate::allows('super-admin')) {
            $pages = Page::all();
            $card = TwitterCard::whereSlug($slug)->first();
            return view('pages.twitter.edit',compact('card','pages'));
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
            $card = TwitterCard::whereSlug($slug)->first();
            $formFields = $request->validate([
                'tag_name'=>'required',
                'title'=>'required',
                'description'=>'required',
                'image'=>'required',
                'site'=>'required',
                'summary'=>'required',
                'page_id'=>'required|unique:twitter_cards,page_id,'.$card->id,
            ],['page_id.unique'=>'Twitter card for this page already exists']);
            $slug = Str::slug($request->title.'_'.Str::random(5));
            $card->update($formFields+['slug'=>$slug]);
            return redirect()->route('cards')->with('message','Twitter card updated successfully');
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
        $card = TwitterCard::whereSlug($slug)->first();
        $card->delete();
        return redirect()->route('cards')->with('message','Twitter card deleted successfully');
    }
}
