<x-app-layout>
    <div class="w-full h-full flex justify-center">
        <div class="bg-white w-5/6 md:w-3/4 lg:w-1/3 h-full mt-16 rounded-lg">
            <div class="p-6 flex space-x-2">
                <div class="flex-col gap-40">
                    <div class="flex flex-row justify-between">
                        <h1 class="text-xl font-bold">{{ $product->name }}</h1>
                    </div>
                    <div class="flex flex-row w-full">
                        <img src="{{ asset('/images/'.$product->photo->url) }}" alt="" title="" class="w-1/2">
                        <p class="mt-4 text-lg text-gray-900 p-3">{{ $product->description }}</p>
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
                            @else
                            <div>
                                <p>You are currently banned.</p>
                                <p>This means you can not leave reviews until your ban expires.</p>
                            </div>
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
            </div>
            
        </div>
    </div>
</x-app-layout>