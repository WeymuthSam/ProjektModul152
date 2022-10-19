<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Exceptions\Node;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class screenshotController extends Controller
{

    public function index()
    {
        try {
            $name = "";
            $error = "";

            Log::info('Returning screenshooter view.');

            return view('screenshooter', ["name" => $name, "error" => $error]);
        } catch (Node\Exception $exception) {
            Log::critical('Returning the view failed');
        }
        
    }

    public function createScreenshot(Request $request)
    {
        $puppeteer = new Puppeteer;

        $url = $request->input('url');
        $name = $request->input('name');
        $width = (int)$request->input('width');
        $height = (int)$request->input('height');
        $imgtype = $request->input('imgtype');

        try {

            $error = "";

            Log::info('Puppetheer running...');
            $browser = $puppeteer->launch();
            $page = $browser->newPage();
            $page->tryCatch->goto($url);
            $page->setViewport(['width' => $width, 'height' => $height]);
            $screenshot = $page->screenshot(['encoding' => 'base64', 'type' => 'png']);
            $browser->close();

            Log::info('Puppetheer done.');

            $image = base64_decode($screenshot);
            //creates a unique key
            $filename = Str::uuid();

            $fullPath = "image/$filename" . ".$imgtype";

            $name = $filename;

            Storage::disk('public')->put($fullPath, $image);
                
            $url = Storage::url($fullPath);

            Log::info('Screenshot created!');

            return view('screenshooter', ["name" => $name, "error" => $error, "url" => $url]);

        } catch (Node\Exception $exception) {

            $error = "Something went wrong :(";

            Log::critical('Screenshot/Puppetheer failed!');

            return view('screenshooter', ["name" => $name, "error" => $error]);

        }
    }
}
