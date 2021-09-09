<div>
    <a href="{{route('category.show', ['category' => $category, 'slug' => Str::slug($category->title)])}}">
        {{$category->title}}
    </a>
</div>