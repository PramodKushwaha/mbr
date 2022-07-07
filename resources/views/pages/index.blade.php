@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <ul>
            @if(!empty($navs))
            @foreach($navs as $page)
            <li><a href="{{url('pages/'.$page['slug'])}}">{{ $page['title']}}</a>
                @if(!empty($page['children']))
                <ul>
                    @foreach($page['children'] as $child)
                    <li><a href="{{url('pages/'.$page['slug'].'/'.$child['slug'])}}">{{ $child['title'] }}</a>
                        @if(!empty($child['children']))
                        <ul>
                            @foreach($child['children'] as $grandChild)
                            <li><a href="{{url('pages/'.$page['slug'].'/'.$child['slug'].'/'.$grandChild['slug'])}}">{{ $grandChild['title'] }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
            @endif
        </ul>
    </div>
</div>
@endsection
