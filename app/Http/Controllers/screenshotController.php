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

    /**
     * When /screenshooter route has been called
     * it will run the function below and will return
     * the screenshooter.blade.view
     */
    public function index()
    {
        try {
            //Instance variables (passed to the view)
            $viewImage = "";
            $error = "";

            //Dev Log
            Log::info('Returning screenshooter view.');

            //View that will be returned
            return view('screenshooter', ["viewImage" => $viewImage, "error" => $error]);
        } catch (Node\Exception $exception) {
            //Dev Log
            Log::critical('Returning the view failed');
            abort(403);
        }
        
    }

    public function createScreenshot(Request $request)
    {
        //Creates a new Puppeteer
        $puppeteer = new Puppeteer;

        //Form data from post request
        $url = $request->input('url');
        $width = (int)$request->input('width');
        $height = (int)$request->input('height');
        $imgtype = $request->input('imgtype');

        try {

            //Set error to empty
            $error = "";

            //Dev Log
            Log::info('Puppetheer running...');

            //Puppeteer opens a new headless browser
            $browser = $puppeteer->launch();
            //Browser opens a new page
            $page = $browser->newPage();
            //Page will open the content provided by the url user has given
            $page->tryCatch->goto($url);
            //It will set the height and width of the page
            $page->setViewport(['width' => $width, 'height' => $height]);
            //Puppeteer will take the screenshot and encode it, will also set the type of the image
            $screenshot = $page->screenshot(['encoding' => 'base64', 'type' => $imgtype]);
            //Puppeteer will close the browser
            $browser->close();

            //Dev Log
            Log::info('Puppetheer done.');

            //Image will be decoded from the base64 encoding type
            $image = base64_decode($screenshot);
            //This will create a unique key that will never be the same
            $filename = Str::uuid();
            //Creates a path where image will be saved and adds the extension to its name
            $fullPath = "image/$filename" . "." . "$imgtype";
            /**
             * Takes the image name so that screenshooter.blade.php knows which image to display upon creation
             * This variable is passed to the view after creation is done.
            */
            $viewImage = $filename;
            //Saves the image to the public storage of laravel.
            Storage::disk('public')->put($fullPath, $image);
            //This will create a url path to the image so that the variable can be passed to the view
            $url = Storage::url($fullPath);
            //Dev Log
            Log::info('Screenshot created!');
            //Returning the view after creating and saving the image
            return view('screenshooter', ["viewImage" => $viewImage, "error" => $error, "url" => $url]);

        } catch (Node\Exception $exception) {
            //If there are any errors, the error will be created, passed to the view and displayed
            $error = "Something went wrong. The url might be invalid. :(";
            //Dev Log
            Log::critical('Screenshot/Puppetheer failed!');
            //Returning the view
            return view('screenshooter', ["viewImage" => $viewImage, "error" => $error]);

        }
    }
}
