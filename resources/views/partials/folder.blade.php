<div class="p-3 shadow-2 rounded-3 border">
    <img src="{{ Voyager::image($category->image) }}" alt="{{ $category->title }} Image" class="mb-3 d-block rounded-3" style="max-height: 5em;">
    <div class="d-inline-flex align-items-center gap-1 border border-dark px-2 rounded-3 mb-2 text-dark"><div class="text-bold">20</div><span>Links</span></div>
    <h6 class="mb-0">{{ $category->title }}</h6>
    <p class="text-secondary">{{ $category->description }}</p>
    <a href="{{ route('category.slug', $category->slug )}}" class="btn btn-dark">Open ></a>
</div>