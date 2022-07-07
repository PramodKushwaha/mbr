<nav class="navbar bg-light px-3">
    <a class="navbar-brand" href="{{url('/')}}">MBR - CMS</a>
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link {{Route::currentRouteName() == 'cms.index' ? 'active':''}}" aria-current="page" href="{{url('cms')}}">Pages </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Route::currentRouteName() == 'cms.create' ? 'active':''}}" href="{{url('cms/create')}}">Add Page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{Route::currentRouteName() == 'pages.index' ? 'active':''}}" href="{{url('pages')}}">Nested Page Structure</a>
        </li>
    </ul>
</nav>