@props([
    'model',
    'editRoute',
    'deleteRoute',
    'deactivateRoute',
    'showRoute', 
])

<div class="btn-group" role="group">
    {{-- Show button --}}
    @isset($showRoute)
        <a href="{{ route($showRoute, $model->id) }}" class="btn btn-sm btn-info mx-1">
            Show
        </a>
    @endisset

    {{-- Edit button --}}
    @isset($editRoute)
        <a href="{{ route($editRoute, $model->id) }}" class="btn btn-sm btn-primary mx-1">
            Edit
        </a>
    @endisset

    {{-- Delete button --}}
    @isset($deleteRoute)
        <form action="{{ route($deleteRoute, $model->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger mx-1"
                onclick="return confirm('Are you sure you want to delete this item?')">
                Delete
            </button>
        </form>
    @endisset

    {{-- Deactivate / Activate button --}}
    @isset($deactivateRoute)
        <form action="{{ route($deactivateRoute, $model->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('POST')
            @if($model->is_active)
                <button type="submit" class="btn btn-sm btn-warning mx-1"
                    onclick="return confirm('Are you sure you want to deactivate this item?')">
                    Deactivate
                </button>
            @else
                <button type="submit" class="btn btn-sm btn-success mx-1"
                    onclick="return confirm('Are you sure you want to activate this item?')">
                    Activate
                </button>
            @endif
        </form>
    @endisset
</div>
