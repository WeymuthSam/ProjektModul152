<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
}
