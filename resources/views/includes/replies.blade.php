@foreach($comments as $comment)
<div class="border-b pb-3">
    <strong class=" text-slate-700">{{ $comment->user->name }}</strong>
    <p class="py-1 ml-1">{{ $comment->comment }}</p>
    <form method="post" action="{{ route('reply.add') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="comment" required class="bg-gray-100 rounded border border-gray-300 leading-normal resize-none w-full py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" placeholder="Ответить...." />
            <input type="hidden" name="post_id" value="{{ $post_id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
        </div>
        <div class="mt-2 flex justify-end">
            <input type="submit" class="px-4 py-1 bg-indigo-600 text-white text-lg font-medium rounded hover:bg-indigo-500 focus:outline-none 
            focus:bg-indigo-500" style="font-size: 0.8em;" value="Ответить" />
        </div>
    </form>
    <div class="ml-4  pl-2">
        @include('includes.replies', ['comments' => $comment->replies])
    </div>
</div>
@endforeach