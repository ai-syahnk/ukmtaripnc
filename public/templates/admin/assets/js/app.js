$(document).ready(function () {
    // ==========================================
    // 1. Sidebar Toggle & Local Storage Logic
    // ==========================================
    const toggleBtn = $('#toggle-sidebar');
    const sidebar = $('#sidebar');
    const overlay = $('#sidebar-overlay');

    // helper untuk cel screen size
    const isMobile = () => $(window).width() <= 768;

    // Load state dari localStorage KHUSUS DESKTOP (karena mobile pakai offcanvas overlay)
    if (!isMobile() && localStorage.getItem('sidebar-collapsed') === 'true') {
        sidebar.addClass('collapsed');
    }

    // Toggle button handler
    toggleBtn.on('click', function () {
        if (isMobile()) {
            sidebar.toggleClass('show');
            overlay.toggleClass('show');
        } else {
            sidebar.toggleClass('collapsed');
            // Simpan status collapse ke localStorage
            localStorage.setItem('sidebar-collapsed', sidebar.hasClass('collapsed'));
        }
    });

    // Handle Mobile Overlay Click (Tutup sidebar)
    overlay.on('click', function () {
        sidebar.removeClass('show');
        overlay.removeClass('show');
    });

    // Set Copyright Year
    if ($('#year').length) {
        $('#year').text(new Date().getFullYear());
    }

    // ==========================================
    // 2. DataTables & SweetAlert Delete Logic (users.html)
    // ==========================================
    if ($('#usersTable').length) {
        // Init DataTable
        const table = $('#usersTable').DataTable({
            responsive: true,
            pageLength: 5,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
        });

        // Delete Row Action
        $('#usersTable tbody').on('click', '.btn-delete', function () {
            const tr = $(this).closest('tr');
            const row = table.row(tr);

            Swal.fire({
                title: 'Yakin akan dihapus?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FEB407', // Bootstrap Danger
                cancelButtonColor: '#6c757d', // Bootstrap Secondary
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hapus row dari datatable (DOM)
                    row.remove().draw();

                    // Tampilkan Bootstrap-style Toast via SweetAlert2
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data berhasil dihapus.',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        });
    }

    // ==========================================
    // 3. Select2 Initialization (form.html)
    // ==========================================
    if ($('.select2').length) {
        // Inisialisasi Single Select2 Role
        $('#roleSelect').select2({
            theme: 'bootstrap-5', // Gunakan theme khusus Bootstrap 5
            placeholder: 'Pilih Role'
        });

        // Inisialisasi Multiple Select2 Permissions
        $('#permissionsSelect').select2({
            theme: 'bootstrap-5',
            placeholder: 'Pilih Permissions',
            allowClear: true
        });
    }

    // ==========================================
    // 4. Form Submit + SweetAlert (form.html)
    // ==========================================
    $('#demoForm').on('submit', function (e) {
        e.preventDefault(); // Stop native post behaviour

        // Grab value form untuk ditampilkan
        const name = $('#inputName').val();
        const role = $('#roleSelect').val();
        const permissions = $('#permissionsSelect').val() || [];

        Swal.fire({
            icon: 'success',
            title: 'Data Submitted!',
            html: `
                <div class="text-start mt-3">
                    <p><strong>Name:</strong> ${name}</p>
                    <p><strong>Role:</strong> ${role}</p>
                    <p><strong>Permissions:</strong> ${permissions.length > 0 ? permissions.join(', ') : '<i>None</i>'}</p>
                </div>
            `,
            confirmButtonColor: '#0d6efd' // Bootstrap Primary Call to Action
        }).then(() => {
            // (Opsional) Reset form & Select2 value
            $('#demoForm')[0].reset();
            $('.select2').val(null).trigger('change');
        });
    });
});
