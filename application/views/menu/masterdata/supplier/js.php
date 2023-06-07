<script type="text/javascript">
    $(document).ready(function() {

        /* Function ClearScreen */
        function ClearScreen() {
            $('#update').prop("disabled", true);
            $('#save').prop("disabled", false);

            $('#nomor').prop('disabled', false).val("");
            $('#alamat').prop('disabled', false).val("");
            $('#nama').prop('disabled', false).val("");
            // $('input[name="statuspkp"]').prop('checked', false);
            $('input[name="statuspkp"]').prop('disabled', false);
            $('#notlp').prop('disabled', false).val(0);
            $('#npwp').prop('disabled', false).val("");
            $('#alamatnpwp').prop('disabled', false).val("");
            $('#aktif').prop('disabled', false);

            $('#npwp').mask('00.000.000.0-000.000', {
                placeholder: "00.000.000.0-000.000"
            });

            $('.aktif').hide();
        };

        /* Maxlength Nomor Telepon */
        $('#notlp[max]:not([max=""])').on('input', function(event) {
            var $this = $(this);
            var maxlength = $this.attr('max').length;
            var value = $this.val();
            if (value && value.length >= maxlength) {
                $this.val(value.substr(0, maxlength));
            }
        })

        $('input[name="statuspkp"]').click(function() {
            if ($('input[name="statuspkp"]:checked').val() == 'true') {
                $('#npwp').prop('disabled', false).val('');
                $('#alamatnpwp').prop('disabled', false).val('');
            } else {
                $('#npwp').val('00.000.000.0-000.000');
                $('#npwp').prop('disabled', true);
                $('#alamatnpwp').prop('disabled', true).val('-');
            }
        })

        /* Validasi Kosong */
        function ValidasiSave() {
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var notlp = $('#notlp').val();
            var npwp = $('#npwp').val();
            var alamatnpwp = $('#alamatnpwp').val();

            if (nama == '' || nama == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Nama tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#nama').focus();
                var result = false;
            } 
            // else if (alamat == '' || alamat == 0) {
            //     Swal.fire({
            //         title: 'Informasi',
            //         icon: 'info',
            //         html: 'Alamat tidak boleh kosong.',
            //         showCloseButton: true,
            //         width: 350,
            //     });
            //     $('#alamat').focus();
            //     var result = false;
            // } else if (notlp == '') {
            //     Swal.fire({
            //         title: 'Informasi',
            //         icon: 'info',
            //         html: 'No. Telp tidak boleh kosong.',
            //         showCloseButton: true,
            //         width: 350,
            //     });
            //     $('#notlp').focus();
            //     var result = false;
            // } else if (npwp == '' || npwp == 0) {
            //     Swal.fire({
            //         title: 'Informasi',
            //         icon: 'info',
            //         html: 'NPWP tidak boleh kosong.',
            //         showCloseButton: true,
            //         width: 350,
            //     });
            //     $('#npwp').focus();
            //     var result = false;
            // } else if (alamatnpwp == '' || alamatnpwp == 0) {
            //     Swal.fire({
            //         title: 'Informasi',
            //         icon: 'info',
            //         html: 'Alamat NPWP tidak boleh kosong.',
            //         showCloseButton: true,
            //         width: 350,
            //     });
            //     $('#alamatnpwp').focus();
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

        /* Save */
        document.getElementById('save').addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var alamat = $('#alamat').val();
            var nama = $('#nama').val();
            var notlp = $('#notlp').val();
            var alamatnpwp = $('#alamatnpwp').val();
            var npwp = $('#npwp').val();
            var statuspkp = $('input[name="statuspkp"]:checked').val();

            if (ValidasiSave() == true) {
                $.ajax({
                    url: "<?= base_url("masterdata/Supplier/Save") ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        nama: nama,
                        alamat: alamat,
                        notlp: notlp,
                        statuspkp: statuspkp,
                        npwp: npwp,
                        alamatnpwp: alamatnpwp
                    },
                    success: function(data) {
                        if (data.nomor != "") {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            $('#nomor').val(data.nomor);
                            $('#alamat').prop('disabled', true);
                            $('#nama').prop('disabled', true);
                            $('input[name="statuspkp"]').prop('disabled', true);
                            $('#notlp').prop('disabled', true);
                            $('#npwp').prop('disabled', true);
                            $('#alamatnpwp').prop('disabled', true);

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

        /* Cari Data Supplier*/
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            $('#t_supplier').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "order": [],
                "scrollX": true,
                "ajax": {
                    "url": "<?= base_url('masterdata/Supplier/CariDataSupplier'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "tblmst_supplier",
                        field: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat",
                            status_pkp: "status_pkp",
                            npwp: "npwp",
                            alamat_npwp: "alamat_npwp",
                            no_telp: "no_telp",
                            status: "status"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            nama: "nama",
                            alamat: "alamat",
                            npwp: "npwp",
                            alamat_npwp: "alamat_npwp",
                            no_telp: "no_telp"
                        },
                        // value: "kodecabang = '" + $('#cabang').val() + "'"
                    },
                },
                "columnDefs": [{
                    "targets": 4,
                    "data": "status_pkp",
                    "render": function(data, type, row, meta) {
                        return (row[4] == 1) ? 'Ya' : 'Tidak';
                    }
                }, {
                    "targets": 8,
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        return (row[8] == 1) ? 'Aktif' : 'Tidak Aktif';
                    }
                }],
            });
        });

        /*Get Data Supplier*/
        $(document).on('click', ".searchsupplier", function() {
            var nomor = $(this).attr("data-id");;
            $.ajax({
                url: "<?= base_url('masterdata/Supplier/DataSupplier'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    nomor: nomor
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#nomor').val(data[i].kode.trim());
                        $('#nama').val(data[i].nama.trim());
                        $('#alamat').val(data[i].alamat.trim());
                        $('#notlp').val(data[i].no_telp.trim());
                        $('#npwp').val(data[i].npwp.trim());
                        $('#alamatnpwp').val(data[i].alamat_npwp.trim());
                        if (data[i].status_pkp.trim() == 1) {
                            $('#yes').prop('checked', true);
                            $('#npwp').prop('disabled', false);
                            $('#alamatnpwp').prop('disabled', false);
                        } else {
                            $('#no').prop('checked', true);
                            $('#npwp').prop('disabled', true);
                            $('#alamatnpwp').prop('disabled', true);
                        }
                        if (data[i].status.trim() == 1) {
                            $('#aktif').prop('checked', true);
                        } else {
                            $('#tidak_aktif').prop('checked', true);
                        }
                    }
                    $('#statuspkp').prop('disabled', false);
                    $('#update').prop('disabled', false);
                    $('#save').prop('disabled', true);
                    $('#nomor').prop('disabled', true);
                    $('.aktif').show();
                }
            }, false);
        });

        /* Update */
        document.getElementById('update').addEventListener("click", function(event) {
            event.preventDefault();
            var nomor = $('#nomor').val();
            var alamat = $('#alamat').val();
            var nama = $('#nama').val();
            var notlp = $('#notlp').val();
            var alamatnpwp = $('#alamatnpwp').val();
            var npwp = $('#npwp').val();
            var statuspkp = $('input[name="statuspkp"]:checked').val();
            var aktif = $('input[name="aktif"]:checked').val();

            if (ValidasiSave() == true) {
                $.ajax({
                    url: "<?= base_url("masterdata/Supplier/Update") ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        nomor: nomor,
                        alamat: alamat,
                        nama: nama,
                        notlp: notlp,
                        statuspkp: statuspkp,
                        npwp: npwp,
                        alamatnpwp: alamatnpwp,
                        aktif: aktif
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.nomor != "") {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            $('#nomor').val(data.nomor);
                            $('#alamat').prop('disabled', true);
                            $('#nama').prop('disabled', true);
                            $('input[name="statuspkp"]').prop('disabled', true);
                            $('#notlp').prop('disabled', true);
                            $('#npwp').prop('disabled', true);
                            $('#alamatnpwp').prop('disabled', true);
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
