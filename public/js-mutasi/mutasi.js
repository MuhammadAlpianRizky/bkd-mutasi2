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

function toggleFileInput(fileInputId) {
    const fileInputContainer = document.getElementById('fileInputContainer-' + fileInputId);

    // Toggle visibility of file input container
    if (fileInputContainer.style.display === 'none' || fileInputContainer.style.display === '') {
        fileInputContainer.style.display = 'block';
    } else {
        fileInputContainer.style.display = 'none';
    }
}

function showFileLink(inputId, linkId) {
    var inputElement = document.getElementById(inputId);
    var linkElement = document.getElementById(linkId);

    if (!linkElement) {
        linkElement = document.createElement('a');
        linkElement.id = linkId;
        linkElement.className = 'btn btn-outline-info';
        linkElement.target = '_blank';
        linkElement.innerHTML = '<i class="fas fa-eye"></i> Lihat File';
        document.body.appendChild(linkElement);
    }

    if (inputElement.files && inputElement.files[0]) {
        linkElement.classList.remove('d-none');
        var fileUrl = URL.createObjectURL(inputElement.files[0]);
        linkElement.href = fileUrl;
    } else {
        linkElement.classList.add('d-none');
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
