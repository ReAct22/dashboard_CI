<script type="text/javascript">
	$(document).ready(function() {

		/** function ClearScreen */
		function ClearScreen() {
			$('#kode').prop("disabled", false).val("");
			$('#nama').prop("disabled", false).val("");

			$('.aktif').hide();

			$('#update').prop("disabled", true);
			$('#save').prop("disabled", false);
		}

		/** Function ValidasiSave */
		function ValidasiSave() {
			// var kode = $('#kode').val();
			var nama = $('#nama').val();

			if (nama == "" || nama == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Nama tidak boleh kosong',
					showCloseButton: true,
					width: 350
				});
				$('#nama').focus();
				var result = false;
			} else {
				var result = true;
			}

			return result
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

		/** Function Find Data */
		document.getElementById("find").addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_kategori').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": true,
				"pageLength": 5,
				"lengthMenu": [5, 10, 25, 50],
				"order": [],
				"ajax": {
					"url": "<?= base_url('masterdata/Kategori/CariDataKategori'); ?>",
					"method": "POST",
					"data": {
						nmtb: "tblmst_category",
						field: {
							kode: "kode",
							nama: "nama",
						},
						sort: "kode",
						where: {
							kode: "kode"
						},
						value: "status = 1"
					},
				}
			});
		});

		/** Function Get Data */
		$(document).on('click', ".searchkategori", function() {
			var kode = $(this).attr("data-id");;
			$.ajax({
				url: "<?= base_url('masterdata/Kategori/DataKategori'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kode').val(data[i].kode.trim());
						$('#nama').val(data[i].nama.trim());
						if (data[i].status.trim() == 1) {
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

		/** Function Save Data */
		document.getElementById('save').addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var nama = $('#nama').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url("masterdata/Kategori/Save") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						nama: nama
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').prop("disabled", true);
							$('#nama').prop("disabled", true);
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

		/** Function Update Data */
		document.getElementById('update').addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var nama = $('#nama').val();
			var aktif = $('input[name="aktif"]:checked').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url("masterdata/Kategori/Update") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						nama: nama,
						aktif: aktif
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').prop("disabled", true);
							$('#nama').prop("disabled", true);
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

		document.getElementById('clear').addEventListener("click", function(event) {
			event.preventDefault();
			ClearScreen()
		})

		ClearScreen();
	});
</script>
