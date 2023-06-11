<script type="text/javascript">
	$(document).ready(function() {

		/* Function ClearScreen */
		function ClearScreen() {
			$('#kode').val("");
			$('#kodepos').prop("disabled", false).val("");
			$('#kota').prop("disabled", false).val("");
			$('#kecamatan').prop("disabled", false).val("");
			$('#kelurahan').prop("disabled", false).val("");
			$('#aktif').prop("disabled", false);

			$('#update').prop("disabled", true);
			$('#save').prop("disabled", false);

			$('.aktif').hide();
		}

		/* Maxlength Nomor HP */
        $('#kodepos[max]:not([max=""])').on('input', function(event) {
            var $this = $(this);
            var maxlength = $this.attr('max').length;
            var value = $this.val();
            if (value && value.length >= maxlength) {
                $this.val(value.substr(0, maxlength));
            }
        })

		/* Validasi Kosong */
		function ValidasiSave() {
			var kode = $('#kodepos').val();
			// var provinsi = $('#provinsi').val();
			var kota = $('#kota').val();
			var kecamatan = $('#kecamatan').val();
			var kelurahan = $('#kelurahan').val();

			if (kode == '' || kode == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kode tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#kodepos').focus();
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
			} else if (kecamatan == '' || kecamatan == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kecamatan tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#kecamatan').focus();
				var result = false;
			} else if (kelurahan == '' || kelurahan == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kelurahan tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#kelurahan').focus();
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
			var kodepos = $('#kodepos').val();
			var kota = $('#kota').val();
			var kecamatan = $('#kecamatan').val();
			var kelurahan = $('#kelurahan').val();
			console.log(kode);

			if(ValidasiSave() == true){
				$.ajax({
					url: "<?= base_url("masterdata/Kodepos/Save") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						kodepos: kodepos,
						kota: kota,
						kecamatan: kecamatan,
						kelurahan: kelurahan
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').val(data.kode);
							$('#kodepos').prop("disabled", true);
							// $('#provinsi').prop("disabled", true);
							$('#kota').prop("disabled", true);
							$('#kecamatan').prop("disabled", true);
							$('#kelurahan').prop("disabled", true);

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

		/* Cari Data */
		document.getElementById("find").addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_kodepos').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": true,
				"pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
				"order": [],
				"ajax": {
					"url": "<?= base_url('masterdata/Kodepos/CariDataKodePos'); ?>",
					"method": "POST",
					"data": {
						nmtb: "tblmst_pos",
						field: {
							kode: "kode",
							kodepos: "kodepos",
							kota: "kota",
							kecamatan: "kecamatan",
							kelurahan: "kelurahan",
							status: "status"
						},
						sort: "kode",
						where: {
							kode: "kode",
							kodepos: "kodepos",
							kota: "kota",
							kecamatan: "kecamatan",
							kelurahan: "kelurahan"
						}
					},
				},
				"columnDefs": [{
                    "targets": 6,
                    "data": "status",
                    "render": function(data, type, row, meta) {
                        return (row[6] == '1') ? 'Aktif' : 'Tidak Aktif';
                    }
                }
			],
			});
		});

		/*Get Data*/
		$(document).on('click', ".searchkodepos", function() {
			var kode = $(this).attr("data-id");;
			$.ajax({
				url: "<?= base_url('masterdata/Kodepos/DataKodePos'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kode').val(data[i].kode.trim());
						$('#kodepos').val(data[i].kodepos.trim());
						$('#kota').val(data[i].kota.trim());
						$('#kecamatan').val(data[i].kecamatan.trim());
						$('#kelurahan').val(data[i].kelurahan.trim());
						if (data[i].status.trim() == '1') {
							$('#aktif').prop('checked', true);
						} else {
							$('#tidak_aktif').prop('checked', true);
						}
					}
					$('#save').prop('disabled', true);
					$('#update').prop('disabled', false);
					$('#kodepos').prop('disabled', true);
					$('.aktif').show();
				}
			}, false);
		});

		/* Update */
		document.getElementById('update').addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var kodepos = $('#kodepos').val();
			var kota = $('#kota').val();
			var kecamatan = $('#kecamatan').val();
			var kelurahan = $('#kelurahan').val();
			var aktif = $('input[name="aktif"]:checked').val();

			if(ValidasiSave() == true){
				$.ajax({
					url: "<?= base_url("masterdata/Kodepos/Update") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						kodepos: kodepos,
						kota: kota,
						kecamatan: kecamatan,
						kelurahan: kelurahan,
						aktif: aktif
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').val(data.kode);
							$('#kodepos').prop("disabled", true);
							// $('#provinsi').prop("disabled", true);
							$('#kota').prop("disabled", true);
							$('#kecamatan').prop("disabled", true);
							$('#kelurahan').prop("disabled", true);
							$('#aktif').prop("disabled", true);

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
		document.getElementById('clear').addEventListener("click", function(event) {
			event.preventDefault();
			ClearScreen();
		})

		ClearScreen();
	});
</script>
