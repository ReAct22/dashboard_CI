<script type="text/javascript">
	$(document).ready(function() {

		/* Function ClearScreen */
		function ClearScreen() {
			$('#update').prop("disabled", true);
			$('#save').prop("disabled", false);

			$('#kodespv').prop('disabled', false).val("");
			$('#namaspv').prop('disabled', false).val("");
			$('#nohp').prop('disabled', false).val("");
			$('#kodecabang').prop("readonly", true).val("<?= $this->session->userdata('mycabang') ?>");
			$('#aktif').prop("disabled", false);

			$('.aktif').hide();
		};

		/* Maxlength Nomor HP */
		$('#nohp[max]:not([max=""])').on('input', function(event) {
			var $this = $(this);
			var maxlength = $this.attr('max').length;
			var value = $this.val();
			if (value && value.length >= maxlength) {
				$this.val(value.substr(0, maxlength));
			}
		})

		/* Validasi Kosong */
		function ValidasiSave() {
			// var kode = $('#kodespv').val();
			var nama = $('#namaspv').val();
			var nohp = $('#nohp').val();

			// if (kode == '' || kode == 0) {
			// 	Swal.fire({
			// 		title: 'Informasi',
			// 		icon: 'info',
			// 		html: 'Kode tidak boleh kosong.',
			// 		showCloseButton: true,
			// 		width: 350,
			// 	});
			// 	$('#kodespv').focus();
			// 	var result = false;
			// } else 
			if (nama == '' || nama == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Nama tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#namaspv').focus();
				var result = false;
			} else if (nohp == '' || nohp == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'No. HP tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#nohp').focus();
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
			var kode = $('#kodespv').val();
			var nama = $('#namaspv').val();
			var nohp = $('#nohp').val();
			var kodecabang = $('#kodecabang').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url("masterdata/Supervisor/Save") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						nama: nama,
						kodecabang: kodecabang,
						nohp: nohp
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kodespv').val(data.kode);
							$('#namaspv').prop('disabled', true);
							$('#kodecabang').prop('kodecabang', true);
							$('#nohp').prop('disabled', true);

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

		/* Cari Data Supervisor*/
		document.getElementById("find").addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_spv').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": true,
				"pageLength": 5,
				"lengthMenu": [5, 10, 25, 50],
				"order": [],
				"ajax": {
					"url": "<?= base_url('masterdata/Supervisor/CariDataSupervisor'); ?>",
					"method": "POST",
					"data": {
						nmtb: "tblmst_supervisor",
						field: {
							kode: "kode",
							nama: "nama",
							nohp: "nohp",
							kodecabang: "kodecabang",
							status: "status"
						},
						sort: "kode",
						where: {
							kode: "kode",
							nama: "nama",
							kodecabang: "kodecabang",
							nohp: "nohp"
						},
					},
				},
				"columnDefs": [{
					"targets": 5,
					"data": "status",
					"render": function(data, type, row, meta) {
						return (row[5] == '1') ? 'Aktif' : 'Tidak Aktif';
					}
				}],
			});
		});

		/*Get Data Supervisor*/
		$(document).on('click', ".searchsupervisor", function() {
			var kode = $(this).attr("data-id");;
			$.ajax({
				url: "<?= base_url('masterdata/Supervisor/DataSupervisor'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kodespv').val(data[i].kode.trim());
						$('#namaspv').val(data[i].nama.trim());
						$('#nohp').val(data[i].nohp.trim());
						$('#kodecabang').val(data[i].kodecabang.trim());
						if (data[i].aktif.trim() == 't') {
							$('#aktif').prop('checked', true);
						} else {
							$('#tidak_aktif').prop('checked', true);
						}
					}
					$('#save').prop('disabled', true);
					$('#update').prop('disabled', false);
					$('#kodespv').prop('disabled', true);
					$('.aktif').show();
				}
			}, false);
		});

		/* Cari Data Barang */
		document.getElementById('caricabang').addEventListener('click', function(event) {
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
							// alamat: "alamat",
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

		/* Get Data Barang */
		$(document).on('click', ".searchcabang", function() {
			var kode = $(this).attr("data-id");
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

		/* Update */
		document.getElementById('update').addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kodespv').val();
			var nama = $('#namaspv').val();
			var kodecabang = $('#kodecabang').val();
			var nohp = $('#nohp').val();
			var aktif = $('input[name="aktif"]:checked').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url("masterdata/Supervisor/Update") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						nama: nama,
						nohp: nohp,
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
							$('#kodespv').val(data.kode);
							$('#namaspv').prop('disabled', true);
							$('#nohp').prop('disabled', true);
							$('#kodecabang').prop('disabled', true);
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
