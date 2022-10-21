<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class galleryController extends Controller
{
    public function index()
    {
        //Gets all images from the storage and passes them to the view
        $images = Storage::disk('public')->allFiles('image');
        //Return the view
        return view('gallery', ["images" => $images]);
    }

    public function downloadImage(Request $request)
    {
        //From the request gets the image
        $image = $request->input('image');
        //Starts the download of the wanted image
        return Storage::download('public/' . $image);
    }

    public function deleteImage(Request $request)
    {   
        //From the request gets the image
        $image = $request->input('image');
        //Deletes the image from the storage
        Storage::disk('public')->delete($image);
        //Return the view
        return redirect('/gallery');
    }

    public function imageToAscii(Request $request)
    {
        //From the request gets the image
        $image = $request->input('image');
        //Dev Log
        Log::info("Converting image to ascii");
        //Path to the image
        $path = Storage::disk('public')->path($image);
        //Finds the python script
        $process = new Process(['python3.10', "py/script.py", $path]);
        //Runs the script
        $process->run();
        //If script had a faliure go back to gallery view
        if(!$process->isSuccessful()) {

            return redirect('/gallery');
        }
        //Output data
        $output_data = $process->getOutput();
        //Display output data
        dd($output_data);
    }
}