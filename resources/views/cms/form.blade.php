@extends('layout.main')
@section('content')
<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ (!empty($page)) ? route('cms.update',[$page->id]) : route('cms.store')}}">
            @csrf
            <div class="row mb-3">
                <label for="inputTitle" class="col-sm-2 col-form-label">Title *</label>
                <div class="col-sm-10">
                    <input type="title" class="form-control" id="inputTitle" name="title" value="{{(!empty($page)) ? $page->title: ''}}" placeholder="Enter Title" required="required">
                    @if ($errors->has('title'))
                    <div class="error" style="color:red">{{ $errors->first('title') }}</div>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputParentPage" class="col-sm-2 col-form-label">Parent Page</label>
                <div class="col-sm-10">
                    <select class="form-select" id="inputParentPage" name="parent_id" aria-label="Default select example">
                        <option value="0" selected>Please Select Page</option>
                        @if(!empty($pages))
                        @foreach($pages as $key =>$p)
                        <option value="{{$key}}" {{ (!empty($page) && ($page->parent_id == $key)) ? 'selected' : '' }}>{{$p}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputContain" class="col-sm-2 col-form-label">Contain *</label>
                <div class="col-sm-10">
                    <textarea placeholder="Enter Contain" name="content" class="form-control" rows="5" id="inputContain" required="required">{{(!empty($page)) ? $page->content:''}}</textarea>
                    @if ($errors->has('content'))
                    <div class="error" style="color:red">{{ $errors->first('content') }}</div>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Page</button>
            <a  class="btn btn-danger" href="{{url('cms')}}">Back</a>
        </form>
    </div>
</div>
@endsection