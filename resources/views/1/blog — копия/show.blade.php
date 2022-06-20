<x-app-layout>
    <div class="container">
        <section class="flex bg-white relative border-gray-300 border flex flex-col overflow-hidden rounded-lg">
            <div class="min-h-full w-auto border-inherit border-b" data-aos="fade-left">
                <img src="{{asset($post->image)}}" class="h-full w-full" alt="" />
            </div>
            
            <div class="flex flex-col flex-1 gap-3 p-6">
                <h1 class="text-lg font-medium">{{$post->title}}</h1>
                <div class="about-text">
                    {!! $post->body !!}
                </div>
                <p class="border-t border-inherit text-right bg-gradient-to-b mt-auto">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </section>
        <section class="mt-6 bg-white border-gray-300 relative border flex flex-col overflow-hidden rounded-lg px-4">
            <h2 class="pt-3 pb-2 text-gray-800 text-lg">Комментарии</h2>
            <form method="post" action="{{ route('comment.add') }}" class="w-full">
                <div class="flex flex-wrap -mx-3 mb-6">
                    @csrf

                    <div class="w-full px-3 mb-2 mt-2">
                        <textarea name="comment" required class="bg-gray-100 rounded border border-gray-300 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" placeholder="Написать комментарий...."></textarea>
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    </div>
                    <div class="w-full flex items-start justify-end md:w-full px-3">
                        <input type="submit" class="px-4 py-2 bg-sky-600 text-white text-md font-medium rounded hover:bg-sky-500 focus:outline-none 
            focus:bg-sky-500" value="Отправить" />
                    </div>
                </div>
            </form>

            <div class="pt-3 mb-12 border-t border-gray-300">
                @include('includes.replies', ['comments' => $post->comments, 'post_id' => $post->id])
            </div>
        </section>
    </div>

</x-app-layout>