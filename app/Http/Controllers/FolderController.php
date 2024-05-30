<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Form;
use App\Models\Sosmed;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class FolderController extends Controller
{
    public function show($slug, Request $request){
        $searched = $request->input('search', '');

        $seo = (object)[
            'title' => setting('meta_title'),
            'desc' => setting('meta_desc'),
            'image' => Voyager::image(setting('image')),
            'keyword' => setting('meta_keyword'),
        ];

        $folder = Folder::where('slug', $slug)->first();
        
        $forms = null;
        if($searched !== '' && $searched != null){
            $forms = Form::where('id_folder', $folder->id)
                    ->where(function($query) use ($searched) {
                        $query->where('title', 'LIKE', '%'.$searched.'%')
                            ->orWhere('description', 'LIKE', '%'.$searched.'%');
                    })
                    ->get();
        }else{
            $forms = $folder->forms;
        }
        
        $sosmeds = Sosmed::all();
        return view('folder.slug', compact('seo', 'sosmeds', 'searched', 'folder', 'forms'));
    }
}
