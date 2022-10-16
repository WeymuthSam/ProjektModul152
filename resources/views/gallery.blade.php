<x-app-layout>
    <div class="min-h-screen py-32 px-10">
        @if ($images == null)
        <div class="p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2 mt-10 border-dashed border-2 border-white">
            <p class="text-center text-gray-400">No screenshots found in gallery!</p>
        </div>
        @else
            @foreach ($images as $image)
            <div class="p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2 mt-10 border-dashed border-2 border-white">
                <img src="{{ "storage/" . $image }}" alt="image.png">
                <form action="/download-image" method="POST">
                    @method('POST')
                    @csrf
                    <input type="text" name="image" value="{{ $image }}" hidden>
                    <button class="w-full bg-blue-500 text-white font-bold p-4 rounded mt-5">Download image</button>
                </form>
                <form action="/delete-image" method="POST">
                    @method('POST')
                    @csrf
                    <input type="text" name="image" value="{{ $image }}" hidden>
                    <button class="w-full bg-red-500 text-white font-bold p-4 rounded mt-5">Delete image</button>
                </form>
                <form action="/convert-to-ascii" method="POST">
                    @method('POST')
                    @csrf
                    <input type="text" name="image" value="{{ $image }}" hidden>
                    <button class="w-full bg-pink-500 text-white font-bold p-4 rounded mt-5">Create an ascii image</button>
                </form>
            </div>
            @endforeach
        @endif
    </div>
</x-app-layout>