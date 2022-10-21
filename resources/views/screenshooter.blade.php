<x-app-layout>
    <div class="min-h-screen py-32 px-10">
        <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">

            @if ($error == !null)
            
            <div class="border-l-4 border-yellow-400 bg-yellow-50 p-4 mb-5">
                <div class="flex">
                    <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8.485 3.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 3.495zM10 6a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 6zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    </div>
                    <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        {{$error}}
                    </p>
                    </div>
                </div>
            </div>

            @endif

            <form method="POST" action="/screenshooter/create">
                @csrf
                <div class="mb-5">
                    <label for="url" class="block mb-2 font-bold text-gray-600 ">Website URL</label>
                    <input type="text" id="url" name="url" placeholder="Enter URL" class="border border-gray-300 w-full p-3 rounded shadow sm:border-blue-500">
                </div>
                <div class="mb-5 flex justify-between">
                    <div>
                        <label for="width" class="block mb-2 font-bold text-gray-600 ">Width</label>
                        <input type="number" id="width" name="width" placeholder="Enter width" class="border border-gray-300 w-full p-3 rounded shadow sm:border-blue-500">
                    </div> 
                    <div>
                        <label for="height" class="block mb-2 font-bold text-gray-600 ">Height</label>
                        <input type="number" id="height" name="height" placeholder="Enter height" class="border border-gray-300 w-full p-3 rounded shadow sm:border-blue-500">
                    </div>
                </div>
                <div class="mb-5">
                     <label for="imagetype" class="block mb-2 font-bold text-gray-600 ">Image Type</label>
                     <select name="imgtype" id="imgtype" class="border border-gray-300 w-full p-3 rounded shadow sm:border-blue-500">
                        <option value="">Choose an option</option>
                        <option value="png">PNG</option>
                        <option value="gif">GIF</option>
                        <option value="svg">SVG</option>
                    </select>
                </div>
                <button class="block w-full bg-blue-500 text-white font-bold p-4 rounded ">Take a screenshot</button>
            </form>
        </div>

        <div class="p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2 mt-10 border-dashed border-2 border-white">
        @if ($name == !null)
            <img src="{{ $url }}" alt="Image can not be loaded">
            <a href="{{$url ?? '#'}}" target="_blank" class="block w-full bg-blue-500 text-white font-bold p-4 rounded mt-4 text-center">See in new tab</a>
        @else
            <p class="text-blue-700">No image created yet!</p>
        @endif

        </div>
    </div>
</x-app-layout>
