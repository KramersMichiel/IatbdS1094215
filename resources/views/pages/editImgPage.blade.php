<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"  @style(['background-color: #fafafa'])>
        <form method="POST" enctype="multipart/form-data" action="{{ route('photo.update', $photo) }}">
            @csrf
            @method('patch')
            <img src="{{ asset('/images/'.$photo->url) }}" alt="" title="">
            <label for="image">Upload new photo: </label>
            <input 
            type="file" 
            name="image"
            >{{ old('image') }}</input>
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
            <div class="mt-4 space-x-2">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
                <a href="{{ route('homePage.index') }}">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>