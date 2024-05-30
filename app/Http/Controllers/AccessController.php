<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;

class AccessController extends Controller
{
    public function index(){
        $seo = (object)[
            'title' => 'Open The Door by Quitely! Kitchen so busy',
            'desc' => setting('meta_desc'),
            'image' => Voyager::image(setting('image')),
            'keyword' => setting('meta_keyword'),
        ];

        return view('unlock', compact('seo'));
    }

    public function unlock(Request $request) {
        $username = setting('site.user_access');
        $password = setting('site.pwd_access');
        if ($request->input('username') === $username && $request->input('password') === $password) {
            $request->session()->put('authenticated_user', true);
            return redirect()->route('home');
        }
    
        return redirect()->route('access')->withErrors(['Invalid Access! worng username or password.. if you cant have a access, we have your IP address kid']);
    }
}
