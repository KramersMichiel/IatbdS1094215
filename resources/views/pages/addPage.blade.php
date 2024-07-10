<x-app-layout>
    <div class="w-full h-full flex justify-center content-center">
        <form method="POST" enctype="multipart/form-data" action="{{ route('product.store') }}" class="">
            @csrf
            <div class="flex flex-col  md:flex-row gap-4 bg-white p-4 rounded-lg w=1/2 mt-20">
                <div class="w-1/2">
                    <textarea
                        name="name"
                        placeholder="{{ __('Add name') }}"
                        class="block h-12 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-120 h-1/4"
                    >{{ old('name') }}</textarea>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    <textarea
                        name="description"
                        placeholder="{{ __('Add description') }}"
                        class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm h-3/4"
                    >{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="w-1/2 flex flex-col">
                    <div class="">
                        <label for="image">Upload photo: </label>
                        <input 
                        type="file" 
                        name="image"
                        >{{ old('image') }}</input>
                        <div class="mt-2 flex flex-col gap-4">
                            <select name="exclusiveCatagory" class="w-40">
                                @foreach ($exclusiveCatagories as $exCatagory)
                                    <option value="{{$exCatagory->name}}">{{$exCatagory->name}}</option>
                                @endforeach
                            </select>
                            <div class="grid grid-cols-3">
                                @foreach ($inclusiveCatagories as $catagory)
                                    <div>
                                        <label for="{{$catagory->name}}">{{$catagory->name}}</label>
                                        <input type="checkbox" name="{{$catagory->name}}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>
                    
                    <x-primary-button class="mt-4 h-12 self-end {{$banned ? 'bg-gray-300' : ''}}" :disabled="$banned" >Add product</x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>