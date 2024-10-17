<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Script;
use App\Models\TwitterCard;
use App\Models\OpenGraph;
use App\Models\Page;

class HomeController extends Controller
{
    private function getDetailsSeo()
    {
        $slug = request()->segment(2);
        $page = Page::whereSlug($slug)->first();
        $page_id = $page->id;
        $meta_tags = Tag::whereSlug($slug)->orWhere('slug','all')->first();
        //script for header
        $scriptHeader = Script::where(function ($query) {
            $query->where('position', 'header')
                ->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->where('position', 'header')
                ->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();
        //open graph
        $openGraph = OpenGraph::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();
        //twitter card
        $twitterCard = TwitterCard::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();


        //script for footer
        $scriptFooter = Script::where(function ($query) {
            $query->where('position', 'footer')
                ->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->where('position', 'footer')
                ->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();
        
        return compact('scriptHeader','scriptFooter','openGraph','twitterCard','meta_tags');
    }

    public function index()
    {
        $meta_tags = Tag::whereSlug('index')->orWhere('slug','all')->first();
        //script for header
        $scriptHeader = Script::where(function ($query) {
            $query->where('position', 'header')
                ->where('page_id', 1);
        })->orWhere(function ($query) {
            $query->where('position', 'header')
                ->where('page_id', 2);
        })->orderBy('created_at', 'asc')->get();

        //open graph
        $openGraph = OpenGraph::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) {
            $query->where('page_id', 2);
        })->orderBy('created_at', 'asc')->get();

        //twitter card
        $twitterCard = TwitterCard::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) {
            $query->where('page_id', 2);
        })->orderBy('created_at', 'asc')->get();

        //script for footer
        $scriptFooter = Script::where(function ($query) {
            $query->where('position', 'footer')
                ->where('page_id', 1);
        })->orWhere(function ($query) {
            $query->where('position', 'footer')
                ->where('page_id', 2);
        })->orderBy('created_at', 'asc')->get();
      
        return view('home.index',compact('meta_tags','scriptHeader','openGraph','twitterCard','scriptFooter'));
    }
    public function blogDetails($slug)
    {
        return view('home.blog',$this->getDetailsSeo(),compact('slug'));
    }
}
