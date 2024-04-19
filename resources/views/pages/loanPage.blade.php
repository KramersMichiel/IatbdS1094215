<x-app-layout>
<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"  @style(['background-color: #fafafa'])>
    <div class="p-6 flex space-x-2">
        <div class="flex-1">
            <div>
                <span class="text-gray-800">{{ $product->name }}</span>
                <small class="ml-2 text-sm text-gray-600">{{ $product->created_at->format('j M Y') }}</small>
            </div>
            <p class="mt-4 text-lg text-gray-900">{{ $product->description }}</p>
            <img src="{{ asset('/images/'.$product->photo->url) }}" alt="" title="">
        </div>
    </div>
    <div>
        <div class="flex gap-4">
            <p>{{'You can borrow this item until: '}}</p>
            <p>{{ $endDate->format('j M Y') }}</p>
        </div>
        <div class="mt-4 space-x-2" @style([
            'display: flex',
            'justify-content: flex-end',
            'gap: 4px'
            ])>
            <a href="{{ route('page.index') }}"><p>{{ __('Cancel') }}</p></a>
            <form method="POST" action="{{ route('product.loan.store', $product) }}">
                @csrf
                <x-primary-button>{{ __('Borrow item') }}</x-primary-button>
            </form>
        </div>
    </div>
</div>
    
</x-app-layout>