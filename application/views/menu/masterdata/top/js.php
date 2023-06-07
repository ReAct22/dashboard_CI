<script type="text/javascript">
    $(document).ready(function() {

        /* Function ClearScreen */
        function ClearScreen() {
            $('#update').prop("disabled", true);
            $('#save').prop("disabled", false);

            $('#kode').prop('disabled', false).val("");
            $('#keterangan').prop('disabled', false).val("");
            $('#jumlah').prop('disabled', false).val("");
            $('#kota').prop('disabled', false).val("");
            $('#aktif').prop('disabled', false);

            $('.aktif').hide();
            $('#save').show();
        };

        /* Validasi Kosong */
        function ValidasiSave() {
            // var kode = $('#kode').val();
            var keterangan = $('#keterangan').val();
            var kota = $('#kota').val();
            var jumlah = $('#jumlah').val();

            if (kode == '' || kode == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Kode tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#kodekg').focus();
                var result = false;
            } else if (keterangan == '' || keterangan == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Keterangan tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#keterangan').focus();
                var result = false;
            } else if (kota == '' || kota == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Kota tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#kota').focus();
                var result = false;
            } else if (jumlah == '' || jumlah == 0) {
                Swal.fire({
                    title: 'Informasi',
                    icon: 'info',
                    html: 'Jumlah tidak boleh kosong.',
                    showCloseButton: true,
                    width: 350,
                });
                $('#jumlah').focus();
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
            var kode = $('#kode').val();
            var keterangan = $('#keterangan').val();
            var jumlah = $('#jumlah').val();
            var kota = $('#kota').val();

            if (ValidasiSave() == true) {
                $.ajax({
                    url: "<?= base_url("masterdata/Top/Save") ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        kode: kode,
                        keterangan: keterangan,
                        jumlah: jumlah,
                        kota: kota
                    },
                    success: function(data) {
                        if (data.kode != "") {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            $('#kode').val(data.kode);
                            $('#keterangan').prop('disabled', true);
                            $('#jumlah').prop('disabled', true);
                            $('#kota').prop('disabled', true);

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

        /* Cari Data Top*/
        document.getElementById("find").addEventListener("click", function(event) {
            event.preventDefault();
            $('#t_top').DataTable({
                "destroy": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
                "order": [],
                "ajax": {
                    "url": "<?= base_url('masterdata/Top/CariDataTop'); ?>",
                    "method": "POST",
                    "data": {
                        nmtb: "tblmst_top",
                        field: {
                            kode: "kode",
                            keterangan: "keterangan",
                            hari: "hari",
                            kota: "kota",
                            status: "status"
                        },
                        sort: "kode",
                        where: {
                            kode: "kode",
                            keterangan: "keterangan",
                            kota: "kota",
                        },
                        // value: "status = true"
                    },
                },
                "columnDefs": [{
                    "targets": 3,
                    "data": "kota",
                    "render": function(data, type, row, meta) {
                        return row[3] + " Hari"
                    }
                }, {
                    "targets": 5,
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        return (row[5] == '1') ? 'Aktif' : 'Tidak Aktif';
                    }
                }],
            });
        });

        /*Get Data Top*/
        $(document).on('click', ".searchtop", function() {
            var kode = $(this).attr("data-id");;
            $.ajax({
                url: "<?= base_url('masterdata/Top/DataTop'); ?>",
                method: "POST",
                dataType: "json",
                async: false,
                data: {
                    kode: kode
                },
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        $('#kode').val(data[i].kode.trim());
                        $('#keterangan').val(data[i].keterangan.trim());
                        $('#kota').val(data[i].kota.trim());
                        $('#jumlah').val(data[i].hari.trim());
                        if (data[i].status.trim() == '1') {
                            $('#aktif').prop('checked', true);
                        } else {
                            $('#tidak_aktif').prop('checked', true);
                        }
                    }
                    $('#update').prop('disabled', false);
                    $('#save').prop('disabled', true);
                    $('#kode').prop('disabled', true);
                    $('.aktif').show();
                }
            }, false);
        });

        /* Update */
        document.getElementById('update').addEventListener("click", function(event) {
            event.preventDefault();
            var kode = $('#kode').val();
            var keterangan = $('#keterangan').val();
            var jumlah = $('#jumlah').val();
            var kota = $('#kota').val();
            var aktif = $('input[name="aktif"]:checked').val();

            if (ValidasiSave() == true) {
                $.ajax({
                    url: "<?= base_url("masterdata/Top/Update") ?>",
                    method: "POST",
                    dataType: "json",
                    async: true,
                    data: {
                        kode: kode,
                        keterangan: keterangan,
                        jumlah: jumlah,
                        kota: kota,
                        aktif: aktif
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.kode != "") {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            $('#kode').prop('disabled', true);
                            $('#keterangan').prop('disabled', true);
                            $('#jumlah').prop('disabled', true);
                            $('#kota').prop('disabled', true);
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
