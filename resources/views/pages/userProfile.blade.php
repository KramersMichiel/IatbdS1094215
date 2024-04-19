<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"  @style(['background-color: #fafafa'])>
        <div class="flex justify-between">
            <div class="flex gap-4">
                <p>{{'Profile of: '}}</p>
                <p>{{$user->name}}</p>
            </div>
            @if (auth()->user()->isAdmin() && auth()->user()->isNot($user))
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('ban.index', $user)">
                            {{ __('Ban user') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            @endif
        </div>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div>
            <p>{{'Listed products'}}</p>
            @foreach ($products as $product)
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $product->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $product->created_at->format('j M Y') }}</small>
                            </div>
                        </div>
                        
                        <p class="mt-4 text-lg text-gray-900">{{ $product->description }}</p>
                        @if ($product->loan()->exists() and $user->is(auth()->user()))
                            <div class="mt-2 flex gap-4">
                                <p>{{"Product borrowed by: "}}</p>
                                <a href="{{ route('page.profile', $product->loan->user) }}"><p>{{$product->loan->user->name}}</p></a>
                            </div>
                            <div class="mt-2 flex gap-4">
                                <p>{{"Review loan and mark as returned: "}}</p>
                                <a href="{{route('product.review.index', $product)}}"><x-primary-button>
                                    {{ __('Review loan') }}
                                </x-primary-button></a>
                            </div>
                        @endif
                        <img src="{{ asset('/images/'.$product->photo->url) }}" alt="" title="" class="mt-2">
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        @if($user->is(auth()->user()))
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div>
            <p>Borrowed items</p>
            @foreach ($loanProducts as $loanProduct)
                <div class="p-6 flex space-x-2">
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-4">
                            <a href="{{ route('page.profile', $loanProduct->user) }}"><span class="text-gray-800">{{ $loanProduct->user->name }}</span></a>
                                <span class="text-gray-800">{{ $loanProduct->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $loanProduct->created_at->format('j M Y') }}</small>
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $loanProduct->description }}</p>
                        <img src="{{ asset('/images/'.$loanProduct->photo->url) }}" alt="" title="" class="mt-2">
                        <div>
                            <p class="mt-4 text-lg text-gray-900">{{ "return by: " }}</p>
                            <p class="text-lg text-gray-900">{{$loanProduct->loan->return_by->format('j M Y')}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        @else
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            <div>
            <p>{{'Peoples reviews of this user'}}</p>
            @foreach ($reviews as $review)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                            <a href="{{ route('page.profile', $review->user) }}"><span class="text-gray-800">{{ $review->user->name }}</span></a>
                                <small class="ml-2 text-sm text-gray-600">{{ $review->created_at->format('j M Y') }}</small>
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $review->review }}</p>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        @endif

    </div>
</x-app-layout>