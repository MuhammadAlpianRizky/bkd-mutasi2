@extends('users.dashboard')

@section('content')
    <main class="content" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <!-- Form untuk semua langkah -->
                    <form id="mutasiForm" action="{{ route('mutasi.update', $mutasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('partials.step1')

                                <!-- Button untuk Lanjut ke Step 2 -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-dark" id="saveSubmitBtn" data-bs-toggle="modal" data-bs-target="#saveModal">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" class="btn btn-primary" id="next-btn" onclick="nextStep()">
                                        <i class="fas fa-arrow-right"></i> Berikutnya
                                    </button>
                                </div>
                            </div>
                        </div>
                        @include('partials.step2')

                                <!-- Navigasi Step -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-secondary" id="prev-btn" onclick="previousStep()">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-dark" id="saveSubmitBtn" data-bs-toggle="modal" data-bs-target="#saveModal">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" name="action" value="finish" id="finish-btn" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#finishModal">
                                        <i class="fas fa-check"></i> Finish
                                    </button>

                                        <!-- Finish Modal -->
                                        <div class="modal fade" id="finishModal" tabindex="-1" aria-labelledby="finishModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="finishModalLabel">Finish</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menyelesaikan pengisian data mutasi?
                                                    </div>
                                    <div class="modal-footer">
                                        <form id="finish-form" action="{{ route('mutasi.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="finish">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Finish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>

    <!-- Save Modal -->
    @include('partials.modal', [
        'id' => 'saveModal',
        'title' => 'Konfirmasi Simpan',
        'slot' => 'Data Anda Tersimpan Sementara dan Bisa Mengedit Nanti',
        'saveButtonText' => 'Ya, Simpan'
    ])

    <script>
        document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk mengirimkan formulir
    function submitForm(action) {
        const form = document.getElementById('mutasiForm');
        if (form) {
            // Tambahkan input tersembunyi untuk menyimpan aksi yang dipilih
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);
            form.submit();
        }
    }

    // Fungsi untuk menambahkan event listener ke tombol modal
    function setupModal(id, action) {
        const modal = document.getElementById(id);
        if (!modal) return;

        const submitBtn = document.getElementById(`${id}-action`);
        if (submitBtn) {
            submitBtn.addEventListener('click', function () {
                submitForm(action);
            });
        }
    }

    // Setup event listeners untuk modals
    setupModal('saveModal', 'save');
});
        function showFileLink(inputId, linkId) {
            const fileInput = document.getElementById(inputId);
            const fileLink = document.getElementById(linkId);

            if (fileInput.files.length > 0) {
                fileLink.classList.remove('d-none');
                fileLink.href = URL.createObjectURL(fileInput.files[0]);
            } else {
                fileLink.classList.add('d-none');
            }
        }

        function nextStep() {
            document.getElementById('step-1').classList.add('d-none');
            document.getElementById('step-2').classList.remove('d-none');
            document.getElementById('prev-btn').disabled = false;
        }

        function previousStep() {
            document.getElementById('step-1').classList.remove('d-none');
            document.getElementById('step-2').classList.add('d-none');
            document.getElementById('prev-btn').disabled = true;
        }
    </script>
@endsection
