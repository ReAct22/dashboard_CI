<script type="text/javascript">
    $(document).ready(function() {

        /* Function ClearScreen */
        function ClearScreen() {
            $('#update').prop("disabled", true);
            $('#save').prop("disabled", false);
            $('#aktif').prop("disabled", false);

            $('#nomor').prop('disabled', false).val("");
            // $('#norek').prop('disabled', false).val("");
            $('#namaaccount').prop('disabled', false).val("");
            $('#jenisacc').prop('disabled', false).val("");

            $('.aktif').hide();
        };

        /* Validasi Kosong */
        function ValidasiSave() {
            var nomor = $('#nomor').val();
            // var norek = $('#norek').val();
            var namaaccount = $('#namaaccount').val();
            var jenisacc = $('#jenisacc').val();

            if (nomor == '' || nomor == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'No. Account tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#nomor').focus();
                var result = false;
            } else if (namaaccount == '' || namaaccount == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Nama Account tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#namaaccount').focus();
                var result = false;
            } else if (jenisacc == '' || jenisacc == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Jenis Account harus dipilih salah satu.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#jenisacc').focus();
                var result = false;
            } else {
                var result = true;
            }

            return result;
        }

        /* Declare Toast */
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        /* Save */
        document.getElementById('save').addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            // var norek = $('#norek').val();
            var namaaccount = $('#namaaccount').val();
            var jenisacc = $('#jenisacc').val();

            if (ValidasiSave() == true) {
                $.ajax({
                    url: "<?= base_url("masterdata/Coa/Save") ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        // norek: norek,
                        namaaccount: namaaccount,
                        jenisacc: jenisacc
                    },
                    success: function(data) {
                        if (data.nomor != "") {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            $('#nomor').prop('disabled', true);
                            // $('#norek').prop('disabled', true);
                            $('#namaaccount').prop('disabled', true);
                            $('#jenisacc').prop('disabled', true);

                            $('#update').prop("disabled", true);
                            $('#save').prop("disabled", true);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.message
                            });
                        }
                    }
                }, false)
            }

        })

        /* Cari Data Coa*/
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            $('#t_coa').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('masterdata/Coa/CariDataCoa'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "tblmst_coa",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            jenis: "jenis",
                            status: "status"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode"
                        },
                        // value: "aktif = true"
                    },
                },
                "columnDefs": [{
                    "targets": 4,
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        return (row[4] == '1') ? 'Aktif' : 'Tidak Aktif';
                    }
                }, {
                    "targets": 3,
                    "data": "jenis",
                    "render": function(data, type, row, meta) {
                        return (row[3] == 1 ? 'Assets' : (row[3] == 2 ? 'Liabilities & Capital' : (row[3] == 3 ? 'Income' : (row[3] == 4 ? 'Expense' : (row[3] == 5 ? 'Additional/Others' : '')))));
                    }
                }],
            });
        });

        /*Get Data Coa*/
        $(document).on('click', ".searchcoa", function() {
            var nomor = $(this).attr("data-id");;
            $.ajax({
                url: "<?= base_url('masterdata/Coa/DataCoa'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].kode.trim());
                        // $('#norek').val(data[i].norekening.trim());
                        $('#namaaccount').val(data[i].nama.trim());
                        $('#jenisacc').val(data[i].jenis.trim());
                        if (data[i].status.trim() == '1') {
                            $('#aktif').prop('checked', true);
                        } else {
                            $('#tidak_aktif').prop('checked', true);
                        }
                    }
                    $('#save').prop('disabled', true);
                    $('#update').prop('disabled', false);
                    $('#nomor').prop('disabled', true);
                    $('.aktif').show();
                }
            }, false);
        });

        /* Update */
        document.getElementById('update').addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            // var norek = $('#norek').val();
            var namaaccount = $('#namaaccount').val();
            var jenisacc = $('#jenisacc').val();
            var aktif = $('input[name="aktif"]:checked').val();


            if (ValidasiSave() == true) {
                $.ajax({
                    url: "<?= base_url("masterdata/Coa/Update") ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        // norek: norek,
                        namaaccount: namaaccount,
                        jenisacc: jenisacc,
                        aktif: aktif
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.nomor != "") {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            $('#nomor').prop('disabled', true);
                            $('#namaaccount').prop('disabled', true);
                            $('#jenisacc').prop('disabled', true);
                            $('#aktif').prop('disabled', true);

                            $('#update').prop("disabled", true);
                            $('#save').prop("disabled", true);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.message
                            });
                        }
                    }
                }, false)
            }
        });

        /* Clear */
        document.getElementById("clear").addEventListener("click", function(event) {
            event.preventDefault();
            ClearScreen();
        });

        ClearScreen();

    });
</script>
