<x-app-layout>
    <div class="h-full w-full flex justify-center content-center">
        <div class="bg-white flex flex-col gap-4 mt-10 md:mt-15 lg:mt-20 p-8 rounded-lg">
            <div>
                <p>You are seeing this page because you took an action that is blocked while you are banned</p>
            </div>
            <div>
                <p>You were banned on:</p>
                <p>{{$ban->created_at->format('j M Y')}}</p>
            </div>
            <div>
                <p>The reason given for your ban is:</p>
                <p>{{$ban->reason_for_ban}}</p>
            </div>
            <div>
                <p>You are banned until:</p>
                <p>{{$ban->banned_until->format('j M Y')}}</p>
            </div>
            <div>
                <p>While you are banned you can not list new items, borrow new items or leave reviews.</p>
                <p>Furthermore items you have listed won't show up in search results.</p>
                <p>You can still view listed products, existing accounts and return items you have already lent out.</p>
            </div>
        </div>
    </div>
</x-app-layout>