@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-lg-12">
        @if(!empty($page))
        <h2>{{$page['title']}}</h2>
        <h3>{{$page['content']}}</h3>
        @else
        <h2>Page not found</h2>
        @endif
    </div>
</div>
@endsection
