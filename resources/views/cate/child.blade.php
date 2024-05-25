<ul>
    @foreach($children as $child)
        <li>
            {{ $child->title }}
            @if(count($child->children))
                @include('cate.child',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
