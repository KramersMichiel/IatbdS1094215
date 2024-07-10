<x-app-layout>
    <div class="flex flex-col lg:grid lg:grid-cols-11">
        <div class=" bg-white shadow-sm divide-y lg:col-span-2 h-full">
            <form method="GET" enctype="multipart/form-data" action="{{ route('page.index') }}" class=" flex flex-col gap-4 p-2">
                @csrf
                <label for="search" class="mt-5">Search name or description </label>
                <textarea
                    name="search"
                    placeholder="{{ __('Search on name or description') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ $request->search }}</textarea>
                <x-input-error :messages="$errors->get('search')" class="mt-2" />
                <div class="flex flex-col mt-1 gap-4">
                    <label for="exclusiveCatagory" class="mt-5">Select desired labels</label>
                    <select name="exclusiveCatagory" class="w-40">
                        @foreach ($exclusiveCatagories as $exCatagory)
                            <option value="{{$exCatagory}}">{{$exCatagory}}</option>
                        @endforeach
                    </select>
                    <div class="grid grid-cols-2 gap-y-4">
                        @foreach ($inclusiveCatagories as $catagory)
                            @php
                                $name = $catagory->name
                            @endphp
                            <div>
                                <label for="{{$name}}">{{$name}}</label>
                                <input type="checkbox" name="{{$name}}"
                            @if($request->$name == 'on') checked="checked" @endif ></input>
                            </div>
                            
                        @endforeach
                    </div>
                </div>
                <x-primary-button class="mt-4 w-36">{{ __('Refine search') }}</x-primary-button>
            </form>
        </div>

        <div class="w-full min-h-screen bg-gray-100 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 lg:col-span-9 gap-y-8 col-start-3">
            @foreach ($products as $product)
                <x-product.card :product=$product :banned=$banned/>
            @endforeach
        </div>
    </div>
</x-app-layout>