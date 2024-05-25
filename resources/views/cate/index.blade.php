<ul>
    @foreach($menus as $menu)
        <li>
            {{ $menu->title }}
            @if(count($menu->children))
                @include('cate.child',['children' => $menu->children])
            @endif
        </li>
    @endforeach
</ul>
