<!-- resources/views/partials/modal.blade.php -->

<div class="modal fade" id="{{ $id ?? 'modal' }}" tabindex="-1" role="dialog" aria-labelledby="{{ $titleId ?? 'modalTitle' }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $titleId ?? 'modalTitle' }}">{{ $title ?? 'Modal Title' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="{{ $id ?? 'modal' }}-action" class="btn btn-primary" data-bs-dismiss="modal">
                    {{ $saveButtonText ?? 'Save changes' }}
                </button>
            </div>
        </div>
    </div>
</div>
