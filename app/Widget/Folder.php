<?php

namespace App\Widget;

use App\Models\Folder as ModelsFolder;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class Folder extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = ModelsFolder::all()->count();
        $string = 'Folder';

        $image = Voyager::image(setting('admin.bg_image'));
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-documentation',
            'title'  => "{$count} {$string}",
            'text'   => "Kelola Folder / Kategori Form, Berikan gambar agar lebih jelas",
            'button' => [
                'text' => "Kelola Folder",
                'link' => route('voyager.folder.index'),
            ],
            'image' => $image ?? voyager_asset('images/widget-backgrounds/01.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', app(ModelsFolder::class));
    }
}
