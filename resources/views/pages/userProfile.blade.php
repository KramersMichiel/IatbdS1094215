<x-app-layout>
    <div class="flex flex-col">
        <div class="flex justify-center bg-white">
            <div class="flex gap-4 p-2">
                <p>{{'Profile of: '}}</p>
                <p>{{$user->name}}</p>
            </div>
            @if (auth()->user()->isAdmin() && auth()->user()->isNot($user))
                <a href="{{route('ban.index', $user)}}"><x-primary-button  class="mt-2">
                    {{ __('Ban user') }}
                </x-primary-button></a>
            @endif
        </div>
        <div class="w-full h-full flex flex-col lg:grid lg:grid-cols-12">
            @if($user->is(auth()->user()))
                <div class="lg:col-span-6 h-full w-full flex flex-col gap-4">
                    <div class="bg-white flex justify-center p-2">
                        <p>Listed items</p>
                    </div>
                    @foreach ($products as $product)
                        <x-product.card :product=$product :banned=false/>
                    @endforeach
                </div>
                <div class="lg:col-span-6 h-full w-full flex flex-col gap-4">
                    <div class="bg-white flex justify-center p-2">
                        <p>Borrowed items</p>
                    </div>
                    @foreach ($loanProducts as $loanProduct)
                        <x-product.card :product=$loanProduct :banned=false/>
                    @endforeach
                </div>
            @else
                <div class="w-full h-full lg:col-span-2 flex flex-col gap-4" @style(['background-color: #fafafa'])>
                    <div class="bg-white flex justify-center p-2">
                        <p>Reviews of this user</p>
                    </div>
                    @foreach ($reviews as $review)
                        <x-product.review-card :review=$review/>
                    @endforeach
                </div>
                <div class="w-full h-full lg:col-span-10 2xl:col-span-10 flex flex-col min-h-screen">
                    <div class="bg-white flex justify-center p-2">
                        <p>Products listed by this user</p>
                    </div>
                    <div class="w-full h-full grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-y-4">
                        @foreach ($products as $product)
                            <x-product.card :product=$product :banned=$banned/>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>