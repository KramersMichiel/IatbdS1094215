<x-app-layout>
    <div class="w-full h-full flex justify-center" >
        <form method="POST" enctype="multipart/form-data" action="{{ route('photo.update', $photo) }}" class="bg-white w-5/6 md:w-3/4 lg:w-1/3 h-full mt-16 rounded-lg p-4">
            @csrf
            @method('patch')
            <div class="w-full h-full flex flex-col gap-4">
                <img src="{{ asset('/images/'.$photo->url) }}" alt="" title="" class="w-1/2">
                <div>
                    <label for="image">Upload new photo: </label>
                    <input 
                    type="file" 
                    name="image"
                    >{{ old('image') }}</input>
                    <x-input-error :messages="$errors->get('image')" class="" />
                </div>
                <div class="space-x-2 flex justify-end">
                    <a href="{{ route('page.index') }}">{{ __('Cancel') }}</a>
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>