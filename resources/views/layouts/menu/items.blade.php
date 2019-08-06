@foreach($items as $item)
    @php($hasChild = $item->hasChildren())
    <li class="nav-item @if($hasChild) dropdown @endif">
        <a class="navbar-nav-link @if($hasChild) dropdown-toggle @endif" @if($hasChild) data-toggle="dropdown"
           @endif href="@if($item->url() =='#') # @else {!! $item->url() !!} @endif"  >{!! $item->title !!} </a>
        @if($hasChild)
            <div class="dropdown-menu">
                @foreach($item->children() as $children)
                    @if($children->HasChildren())
                        <div class="dropdown-submenu">
                            <a href="#" class="dropdown-item dropdown-toggle">{!! $children->title !!}</a>
                            <div class="dropdown-menu">
                                @foreach($children->children() as $grandchildren)
                                    <a href="{!! $grandchildren->url() !!}"
                                       class="dropdown-item">{!! $grandchildren->title !!}</a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{!! $children->url() !!}" class="dropdown-item">{!! $children->title !!}</a>
                    @endif
                @endforeach
            </div>
        @endif
    </li>
@endforeach
