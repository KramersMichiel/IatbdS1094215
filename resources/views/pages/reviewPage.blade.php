<x-app-layout>
<div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"  @style(['background-color: #fafafa'])>
    <div class="p-6 flex space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
        </svg>
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
            <p>{{'The deadline for this product was: '}}</p>
            <p>{{$product->loan->return_by->format('j M Y')}}</p>
    </div>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('product.review.store', $product) }}">
            @csrf
            @if(!$banned)
                <label for="review">Write a review(optional)</label>
                <textarea
                    name="review"
                    placeholder="{{ __('Review your experience with the loaner') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('review') }}</textarea>
                <x-input-error :messages="$errors->get('review')" class="mt-2" />
            @endif
            <div class="mt-4 space-x-2" class="mt-4 space-x-2" @style([
            'display: flex',
            'justify-content: flex-end',
            'gap: 4px'
            ])>
                <a href="{{ route('page.index') }}">{{ __('Cancel') }}</a>
                <x-primary-button>{{ __('Mark as returned') }}</x-primary-button>
            </div>
        </form>
    </div>
</div>
    
</x-app-layout>