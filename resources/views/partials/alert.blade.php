<!-- resources/views/partials/alert.blade.php -->
@if(session('alert'))
    <div class="alert alert-{{ session('alert.type') }} alert-dismissible fade show" role="alert">
        {{ session('alert.message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
