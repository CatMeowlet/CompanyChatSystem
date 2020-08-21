<div class="col-md-3">
    <div class="card">
        <div class="card-header">{{ __('Search') }}</div>

        <div class="card-body">
            <form method="GET" action="{{route('user.search_result')}}">
                <div class="input-group">
                    <input type="text" name="search" id="search" class="typeahead form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="submit">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">{{ __('Contact') }}</div>

        <div class="card-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
