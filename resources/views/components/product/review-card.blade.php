<div class="p-6 flex space-x-2">
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