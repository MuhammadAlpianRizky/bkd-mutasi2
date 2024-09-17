<!-- Finish Button -->

<!-- Finish Modal -->
<div class="modal fade" id="finishModal" tabindex="-1" aria-labelledby="finishModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="finishModalLabel">Finish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to finish?
            </div>
            <div class="modal-footer">
                <form id="finish-form" action="{{ route('mutasi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="action" value="finish">
                    <button type="submit" class="btn btn-primary">Finish</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
