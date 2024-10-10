document.getElementById('file').addEventListener('change', function() {
        var fileInput = this;
        var file = fileInput.files[0];

        // Pastikan file telah dipilih
        if (file) {
            // Tampilkan tombol "View"
            var viewButton = document.getElementById('view-file');
            viewButton.classList.remove('d-none');
            viewButton.href = URL.createObjectURL(file); // Set href ke file yang diunggah
        }
    });
