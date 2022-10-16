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

        /**
         * Without Laravel Storage, get from public folder
         */
        //$directory = public_path("img");
        //$images = array_diff(scandir($directory), array('.', '..'));

        $images = Storage::disk('public')->allFiles('image');

        return view('gallery', ["images" => $images]);
    }

    public function downloadImage(Request $request)
    {
        $image = $request->input('image');

        return Storage::download('public/' . $image);
    }

    public function deleteImage(Request $request)
    {
        $image = $request->input('image');

        Storage::disk('public')->delete($image);

        return redirect('/gallery');
    }

    public function imageToAscii(Request $request)
    {
        $image = $request->input('image');

        // $imagePath = Storage::url($image);

        Log::info("Converting image to ascii");

        $path = "py/banana.png";

        $process = new Process(['python3.10', "py/script.py", $path]);

        // $process = new Process(['python', '/path/to/script.py', $arg]);

        $process->run();

        if(!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output_data = $process->getOutput();

        dd($output_data);
    }
}