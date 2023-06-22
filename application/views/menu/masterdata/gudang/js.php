<script type="text/javascript">
    $(document).ready(function() {

        /* Function ClearScreen */
        function ClearScreen() {
            $('#update').prop("disabled", true);
            $('#save').prop("disabled", false);

            $('#kodegdg').prop('disabled', false).val("");
            $('#namagdg').prop('disabled', false).val("");
            $('#alamat').prop('disabled', false).val("");
            $('#kodecabang').val("<?= $this->session->userdata('mycabang'); ?>");
            $('input[name="status"]').prop('disabled', false);
            $('input[name="status"]').prop('checked', false);
            $('#aktif').prop('disabled', false);

            $('.aktif').hide();
            $('#carikodecabang').show();
        };

        /* Validasi Kosong */
        function ValidasiSave() {
            var kode = $('#kodegdg').val();
            var nama = $('#namagdg').val();
            var kodecabang = $('#kodecabang').val();
            var alamat = $('#alamat').val();
            var status = $('.status').val();

            if (kodecabang == '') {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Kode Cabang tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#kodecabang').focus();
                var result = false;
            } else if (kode == '' || kode == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Kode tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#kodegdg').focus();
                var result = false;
            } else if (nama == '' || nama == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Nama tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#namagdg').focus();
                var result = false;
            } else if (alamat == '' || alamat == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Alamat tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#alamat').focus();
                var result = false;
            }
            // else if (status == '' || status == 0) {
            //     Swal.fire({
            //         title: 'Informasi',
            //         icon: 'info',
            //         html: 'Status pilih salah satu Utama/Tidak.',
            //         showCloseButton: true,
            //         width: 350,
            //     });
            //     $('#status').focus();
            //     var result = false;
            // } 
            else {
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

        /* Cari Data Cabang*/
        document.getElementById("carikodecabang").addEventListener("click", function(event) {
            event.preventDefault();
            $('#t_cabang').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('masterdata/Cabang/CariDataCabang'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "tblmst_cabang",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            // alamat: "alamat"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            // alamat: "alamat"
                        },
                        value: "status = 1"
                    },
                }
            });
        });

        /*Get Data Cabang*/
        $(document).on('click', ".searchcabang", function() {
            var kode = $(this).attr("data-id");;
            $.ajax({
                url: "<?= base_url('masterdata/Cabang/DataCabang'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodecabang').val(data[i].kode.trim());
                    }
                }
            }, false);
        });

        /* Save */
        document.getElementById('save').addEventListener("click", function(event) {
            event.preventDefault();
            var kode = $('#kodegdg').val();
            var nama = $('#namagdg').val();
            var alamat = $('#alamat').val();
            var kodecabang = $('#kodecabang').val();
            var status = $('input[name="status"]:checked').val();

            if (ValidasiSave() == true) {
                $.ajax({
                    url: "<?= base_url("masterdata/Gudang/Save") ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    ContentType: "application/json; charset=utf-8",
                    data: {
                        kode: kode.toUpperCase(),
                        nama: nama,
                        alamat: alamat,
                        kodecabang: kodecabang,
                        status: status
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.kode != "") {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            $('#kodegdg').prop('disabled', true);
                            $('#namagdg').prop('disabled', true);
                            $('#alamat').prop('disabled', true);
                            $('#kodecabang').prop('readonly', true);
                            $('#status').prop('disabled', true);

                            $('#carikodecabang').hide();
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

        /* Cari Data Gudang*/
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            $('#t_gudang').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('masterdata/Gudang/CariDataGudang'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "tblmst_gudang",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat",
                            kodecabang: "kodecabang",
                            status_gudang: "status_gudang",
                            status: "status"

                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat",
                            kodecabang: "kodecabang"
                        }
                    },
                },
                "columnDefs": [{
                    "targets": 5,
                    "data": "status_gudang",
                    "render": function(data, type, row, meta) {
                        return (row[5] == '1') ? "<p>Utama</p>" : "<p>-</p>";
                    }
                }, {
                    "targets": 6,
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        return (row[6] == '1') ? 'Aktif' : 'Tidak Aktif';
                    }

                }]
            });
        });

        /*Get Data Gudang*/
        $(document).on('click', ".searchgudang", function() {
            var kode = $(this).attr("data-id");;
            $.ajax({
                url: "<?= base_url('masterdata/Gudang/DataGudang'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kodegdg').val(data[i].kode.trim());
                        $('#namagdg').val(data[i].nama.trim());
                        // $('#status').val(data[i].status.trim());
                        $('#kodecabang').val(data[i].kodecabang.trim());
                        $('#alamat').val(data[i].alamat.trim());
                        if (data[i].status_gudang.trim() == '1') {
                            $('#utama').prop('checked', true);
                        } else {
                            $('#tidak_utama').prop('checked', true);
                        }
                        if (data[i].status.trim() == '1') {
                            $('#aktif').prop('checked', true);
                        } else {
                            $('#tidak_aktif').prop('checked', true);
                        }
                    }
                    $('#save').prop('disabled', true);
                    $('#update').prop('disabled', false);
                    $('#kodegdg').prop('disabled', true);
                    $('.aktif').show();
                }
            }, false);
        });

        /* Update */
        document.getElementById('update').addEventListener("click", function(event) {
            event.preventDefault();
            var kode = $('#kodegdg').val();
            var nama = $('#namagdg').val();
            var alamat = $('#alamat').val();
            var status = $('input[name="status"]:checked').val();
            var kodecabang = $('#kodecabang').val();
            var aktif = $('input[name="aktif"]:checked').val();

            if (ValidasiSave() == true) {
                $.ajax({
                    url: "<?= base_url("masterdata/Gudang/Update") ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        kode: kode,
                        nama: nama,
                        alamat: alamat,
                        status: status,
                        kodecabang: kodecabang,
                        aktif: aktif
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.kode != "") {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            $('#kodegdg').prop('disabled', true);
                            $('#namagdg').prop('disabled', true);
                            $('#alamat').prop('disabled', true);
                            $('#kodecabang').prop('readonly', true);
                            $('#status').prop('disabled', true);
                            $('#aktif').prop('disabled', true);

                            $('#carikodecabang').hide();
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
