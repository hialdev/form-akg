<?php

namespace App\Widget;

use App\Models\Sosmed as ModelsSosmed;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class Sosmed extends BaseDimmer
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
        $count = ModelsSosmed::all()->count();
        $string = 'Sosmed';

        $image = Voyager::image(setting('admin.bg_image'));
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-documentation',
            'title'  => "{$count} {$string}",
            'text'   => "Kelola Sosmed dan Icon dari Iconify",
            'button' => [
                'text' => "Kelola Sosmed",
                'link' => route('voyager.sosmed.index'),
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
        return Auth::user()->can('browse', app(ModelsSosmed::class));
    }
}
