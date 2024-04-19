<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"  @style(['background-color: #fafafa'])>
        <form method="POST" enctype="multipart/form-data" action="{{ route('product.store') }}">
            @csrf
            <textarea
                name="name"
                placeholder="{{ __('Add name') }}"
                class="block h-12 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('name') }}</textarea>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <textarea
                name="description"
                placeholder="{{ __('Add description') }}"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
            <label for="image">Upload photo: </label>
            <input 
            type="file" 
            name="image"
            >{{ old('image') }}</input>
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
            <div class="mt-2">
                <select name="exclusiveCatagory">
                    @foreach ($exclusiveCatagories as $exCatagory)
                        <option value="{{$exCatagory->name}}">{{$exCatagory->name}}</option>
                    @endforeach
                </select>
            @foreach ($inclusiveCatagories as $catagory)
                <label for="{{$catagory->name}}">{{$catagory->name}}</label>
                <input type="checkbox" name="{{$catagory->name}}">
            @endforeach
            </div>
            <x-primary-button class="mt-4 {{$banned ? 'bg-gray-300' : ''}}" :disabled="$banned" >Add product</x-primary-button>
        </form>
    </div>
</x-app-layout>