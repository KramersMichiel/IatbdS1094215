<div class="w-80 lg:w-96 max-h-80 lg:max-h-60 bg-white flex-auto mx-auto rounded-md">
    <div class="w-full p-1 bg-green-200 rounded-t-md">
        <div class="flex justify-between">
            <h2>{{$product->name}}</h2>
            <x-product.dropdown :product=$product :banned=$banned />
        </div>
        <div class="w-full">
            @if ($product->loan()->exists() and $product->user->is(auth()->user()))
                <span class="text-gray-800">Product loaned by: </span>
                <a href="{{ route('page.profile', $product->loan->user) }}"><span class="text-gray-800">{{$product->loan->user->name}}</span></a>
            @else
                <a href="{{ route('page.profile', $product->user) }}"><span class="text-gray-800">{{ $product->user->name }}</span></a>
            @endif
            <small class="ml-2 text-sm text-gray-600 float-right">{{ $product->created_at->format('j M Y') }}</small>
        </div>
    </div>
    <div class="flex flex-row">
        <img src="{{ asset('/images/'.$product->photo->url) }}" alt="" title="" class=" max-w-52 lg:max-w-60 max-h-40">
        <div class=" bg-white flex flex-col justify-between h-full w-full items-stretch">
            <p class="min-w-18 lg:min-w-36 p-2">{{$product->description}}</p>
            @if($product->user->isnot(auth()->user()) and !$product->loan()->exists())
                @if($banned)
                    <a href="{{route('ban.show', auth()->user()->ban)}}"><x-primary-button class="mt-4 w-24 lg:w-36">{{ __('Borrow item') }}</x-primary-button></a>
                @else
                    <a href="{{route('product.loan.index', $product)}}"><x-primary-button class="mt-4 w-24 lg:w-36">{{ __('Borrow item') }}</x-primary-button></a>
                @endif
            @elseif ($product->loan()->exists() and $product->user->is(auth()->user()))
                <a href="{{route('product.review.index', $product)}}"><x-primary-button  class="mt-4 w-24 lg:w-36">
                    {{ __('Review loan') }}
                </x-primary-button></a>
            @endif
        </div>
    </div>
</div>