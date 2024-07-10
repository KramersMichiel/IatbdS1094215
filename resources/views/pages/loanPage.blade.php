<x-app-layout>
    <div class="w-full h-full flex justify-center">
        <div class="bg-white w-5/6 md:w-3/4 lg:w-1/3 h-full rounded-lg mt-16">
            <div class="p-6 flex space-x-2">
                <div class="flex-col gap-40 w-full">
                    <div class="flex flex-col md:flex-row justify-between">
                        <h1>{{ $product->name }}</h1>
                        <div class="flex flex-row gap-2">
                            <p>{{'You can borrow this item until: '}}</p>
                            <p>{{ $endDate->format('j M Y') }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row w-full">
                        <img src="{{ asset('/images/'.$product->photo->url) }}" alt="" title="" class="w-1/2">
                        <p class="mt-4 text-lg text-gray-900 p-3">{{ $product->description }}</p>
                    </div>
                    <div class="mt-4 space-x-2 flex flex-row justify-end gap-4">
                        <a href="{{ route('page.index') }}"><p>{{ __('Cancel') }}</p></a>
                        <form method="POST" action="{{ route('product.loan.store', $product) }}">
                            @csrf
                            <x-primary-button>{{ __('Borrow item') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>