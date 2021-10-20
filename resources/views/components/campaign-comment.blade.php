@props(['comment'])
<article class="flex justify-end mb-2">
    <div class="bg-gray-100 p-3 rounded-xl w-2/3">
    <div>
        <header>
            
            <h3>{{$comment->user->name}}</h3>
            <p class="text-sm">
                Posted <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time>
            </p>
        </header>
        <p>Rated: {{$comment->star}}</p>
        <p>            
           {{ $comment->body}}
        </p>
    </div>
    </div>
</article>