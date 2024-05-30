<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Form;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class PageController extends Controller
{
    public function index(){
        $seo = (object)[
            'title' => setting('meta_title'),
            'desc' => setting('meta_desc'),
            'image' => Voyager::image(setting('image')),
            'keyword' => setting('meta_keyword'),
        ];
        $folders = Folder::latest()->get();
        $all_forms = Form::latest()->get();
        $count = (object)[
            'folder' => count($folders),
            'form' => count($all_forms),
        ];

        $forms = Form::latest()->limit(6)->get();

        $sosmeds = Sosmed::all();

        return view('index', compact('seo', 'count', 'forms', 'folders', 'sosmeds'));
    }

    public function search($q){
        $seo = (object)[
            'title' => 'Mencari Folder atau Form : '.$q,
            'desc' => setting('meta_desc'),
            'image' => Voyager::image(setting('image')),
            'keyword' => setting('meta_keyword'),
        ];
        $folders = Folder::where(function($query) use ($q) {
                        $query->where('title', 'LIKE', '%'.$q.'%')
                        ->orWhere('description', 'LIKE', '%'.$q.'%');
                    })->get();
        $forms = Form::where(function($query) use ($q) {
                    $query->where('title', 'LIKE', '%'.$q.'%')
                    ->orWhere('description', 'LIKE', '%'.$q.'%');
                })->get();
        $count = (object)[
            'folder' => count($folders),
            'form' => count($forms),
        ];

        $sosmeds = Sosmed::all();
        
        return view('search', compact('seo', 'q', 'count', 'forms', 'folders', 'sosmeds'));
    }
}
