@foreach($reviews as $review)
<div class="border-b pb-3">
    <strong class=" text-slate-700">{{ $review->user->name }}</strong>
    <p class="py-1 ml-1">{{ $review->review }}</p>
</div>
@endforeach