// Konfirmasi sebelum menyelesaikan pengajuan
document.getElementById('finish-btn').addEventListener('click', function(event) {
    event.preventDefault(); // Mencegah form dikirim langsung

    // Tampilkan konfirmasi menggunakan SweetAlert
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data akan diproses dan Anda tidak dapat mengedit lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, selesai!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna mengonfirmasi, submit form dengan action 'finish'
            const form = this.closest('form');
            const finishInput = document.createElement('input');
            finishInput.setAttribute('type', 'hidden');
            finishInput.setAttribute('name', 'action');
            finishInput.setAttribute('value', 'finish');
            form.appendChild(finishInput);
            form.submit();
        }
    });
});

// Fungsi untuk validasi upload file
function validateFileUpload(inputId, maxSize) {
    const inputElement = document.getElementById('file-' + inputId);
    const validationMessageElement = document.getElementById('validation-message-' + inputId);
    validationMessageElement.textContent = ''; // Reset pesan validasi

    const file = inputElement.files[0];

    if (file) {
        const fileSizeInKB = file.size / 1024; // Convert bytes to KB
        const allowedTypes = inputElement.accept.split(',').map(type => type.trim());

        // Validasi ukuran file
        if (fileSizeInKB > maxSize) {
            validationMessageElement.textContent = `Ukuran file terlalu besar silahkan upload lagi.`;
            inputElement.value = ''; // Kosongkan input jika tidak valid
            return;
        }

        // Validasi tipe file
        const fileExtension = file.name.split('.').pop();
        if (!allowedTypes.includes(`.${fileExtension}`)) {
            validationMessageElement.textContent = `Format file tidak diperbolehkan. Silakan unggah file dengan format: ${allowedTypes.join(', ')}`;
            inputElement.value = ''; // Kosongkan input jika tidak valid
            return;
        }

        // Jika valid, tampilkan link untuk melihat file
        const linkId = 'view-' + inputId;
        const linkElement = document.getElementById(linkId);
        linkElement.classList.remove('d-none');
        linkElement.href = URL.createObjectURL(file);
    }
}

// Fungsi untuk toggle input file
function toggleFileInput(fileInputId) {
    const fileInputContainer = document.getElementById('fileInputContainer-' + fileInputId);
    // Toggle visibility of file input container
    if (fileInputContainer.style.display === 'none' || fileInputContainer.style.display === '') {
        fileInputContainer.style.display = 'block';
    } else {
        fileInputContainer.style.display = 'none';
    }
}

// Fungsi untuk menampilkan link file
function showFileLink(inputId, linkId) {
    var inputElement = document.getElementById(inputId);
    var linkElement = document.getElementById(linkId);

    if (inputElement.files && inputElement.files[0]) {
        linkElement.classList.remove('d-none');
        var fileUrl = URL.createObjectURL(inputElement.files[0]);
        linkElement.href = fileUrl;
    } else {
        linkElement.classList.add('d-none');
    }
}

// Fungsi untuk berpindah ke langkah berikutnya
function nextStep() {
    document.getElementById('step-1').classList.add('d-none');
    document.getElementById('step-2').classList.remove('d-none');
    document.getElementById('prev-btn').disabled = false;
}

// Fungsi untuk kembali ke langkah sebelumnya
function previousStep() {
    document.getElementById('step-1').classList.remove('d-none');
    document.getElementById('step-2').classList.add('d-none');
    document.getElementById('prev-btn').disabled = true;
}
