<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8" @style(['background-color: #fafafa'])>
        
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <form method="GET" enctype="multipart/form-data" action="{{ route('page.index') }}">
                @csrf
                <textarea
                    name="search"
                    placeholder="{{ __('Search on name or description') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ $request->search }}</textarea>
                <x-input-error :messages="$errors->get('search')" class="mt-2" />
                <div class="flex gap-4 flex-wrap mt-1">
                    <select name="exclusiveCatagory">
                        @foreach ($exclusiveCatagories as $exCatagory)
                            <option value="{{$exCatagory}}">{{$exCatagory}}</option>
                        @endforeach
                    </select>
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
                <x-primary-button class="mt-4">{{ __('Refine search') }}</x-primary-button>
            </form>
            @foreach ($products as $product)
                <div class="p-6 flex space-x-2">
                    
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-4">
                                <a href="{{ route('page.profile', $product->user) }}"><span class="text-gray-800">{{ $product->user->name }}</span></a>
                                <span>{{ $product->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $product->created_at->format('j M Y') }}</small>
                            </div>
                            @if ($product->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('product.edit', $product)">
                                            {{ __('Edit info') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('photo.edit', $product->photo)">
                                            {{ __('Edit photo') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('product.destroy', $product) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('product.destroy', $product)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete listing') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                            @if ($product->user->isnot(auth()->user()) && $product->loan()->doesntExist() && !$banned)
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('product.loan.index', $product)">
                                            {{ __('Borrow item') }}
                                        </x-dropdown-link>
                                        @if(auth()->user()->isAdmin())
                                            <x-dropdown-link :href="route('ban.index', $product->user)">
                                                {{ __('Ban user') }}
                                            </x-dropdown-link>
                                        @endif
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $product->description }}</p>
                        <!-- <p class="mt-4 text-lg text-gray-900">catagories:</p>
                        @foreach($product->catagories()->getModels() as $catagory)
                            <p class="mt-4 text-lg text-gray-900">{{$catagory->name}}</p>
                        @endforeach -->
                        <img src="{{ asset('/images/'.$product->photo->url) }}" alt="" title="">
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>