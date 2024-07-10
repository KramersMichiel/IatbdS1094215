@if($product->user->is(auth()->user()) || auth()->user()->isAdmin())
<x-dropdown>
    <x-slot name="trigger">
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
            </svg>
        </button>
        <x-slot name="content">
            @if ($product->user->is(auth()->user()))
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
            @elseif (auth()->user()->isAdmin())
                <x-dropdown-link :href="route('ban.index', $product->user)">
                    {{ __('Ban user') }}
                </x-dropdown-link>
            @endif
        </x-slot>
    </x-slot>
</x-dropdown>
@endif