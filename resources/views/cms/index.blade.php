@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Parent Page</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Contain</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data->toArray()))
                @foreach($data as $page)
                <tr>
                    <td>{{$page->id}}</td>
                    <td>{{$page->title}}</td>
                    <td>{{$page->parent_page}}</td>
                    <td>{{$page->slug}}</td>
                    <td>{{$page->content}}</td>
                    <td><a href="{{url('cms/edit/'.$page->id)}}">Edit</a> <a onClick="deleteConfirm({{$page->id}})" href="javascript:void(0)">Delete</a></td>
                </tr>
                @endforeach
                @else
                <tr> <td colspan="6">No Record Found</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
    function deleteConfirm(id) {
    if (confirm("Are you sure you want to delete this?")) {
    $.ajax(
    {
    url: "cms/delete",
            type: 'DELETE',
            data: {
            "id": id,
            "_token": '{{ csrf_token() }}',
            },
            success: function (result) {
            var obj = JSON.parse(result);
            if (obj.status == 'success') {
            location.reload();
            }
            }
    });
    } else {
    return false;
    }
    }
</script>
@endpush