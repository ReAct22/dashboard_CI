<script type="text/javascript">
	$(document).ready(function() {

		/* Function ClearScreen */
		function ClearScreen() {
			$('#kode').prop('disabled', false).val("");
			$('#nama').prop('disabled', false).val("");
			$('#kodesatuan').prop('readonly', true).val("");
			$('#kodekategori').prop('readonly', true).val("");
			$('#kodemerk').prop('readonly', true).val("");
			$('#aktif').prop('disabled', false);

			$('#update').prop('disabled', true);
			$('#save').prop('disabled', false);

			$('.aktif').hide();
		};

		/* Validasi Kosong */
		function ValidasiSave() {
			var kode = $('#kode').val();
			var nama = $('#nama').val();
			var kodesatuan = $('#kodesatuan').val();
			var kodemerk = $('#kodemerk').val();
			var kodekategori = $('#kodekategori').val();

			if (kode == '' || kode == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kode tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#kode').focus();
				var result = false;
			} else if (nama == '' || nama == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Nama tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#nama').focus();
				var result = false;
			} else if (kodesatuan == '') {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kode Satuan tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#kodesatuan').focus();
				var result = false;
			} else if (kodemerk == '') {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kode Merk tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#kodemerk').focus();
				var result = false;
			} else if (kodekategori == '') {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kode Kategori tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#kodekategori').focus();
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

		// $('#komisi').mask('99.99%', {
		//     reverse: true
		// });

		/* Cari Data Satuan*/
		document.getElementById("carisatuan").addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_satuan').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": true,
				"pageLength": 5,
				"lengthMenu": [5, 10, 25, 50],
				"order": [],
				"ajax": {
					"url": "<?= base_url('masterdata/Satuan/CariDataSatuan'); ?>",
					"method": "POST",
					"data": {
						nmtb: "tblmst_satuan",
						field: {
							kode: "kode",
							nama: "nama",
							// qtysatuan: "qtysatuan",
							// konversi: "konversi",
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

		/*Get Data Satuan */
		$(document).on('click', ".searchsatuan", function() {
			var kode = $(this).attr("data-id");;
			$.ajax({
				url: "<?= base_url('masterdata/Satuan/DataSatuan'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kodesatuan').val(data[i].kode.trim());
					}
				}
			}, false);
		});

		/* Cari Data Merk*/
		document.getElementById("carikategori").addEventListener("click", function(event) {
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

		/*Get Data Ketegori */
		$(document).on('click', ".searchkategori", function() {
			var kode = $(this).attr("data-id");
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
						$('#kodekategori').val(data[i].kode.trim());
					}
				}
			}, false);
		});

		/* Cari Data Merk*/
		document.getElementById("carimerk").addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_merk').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": true,
				"pageLength": 5,
				"lengthMenu": [5, 10, 25, 50],
				"order": [],
				"ajax": {
					"url": "<?= base_url('masterdata/Merk/CariDataMerk'); ?>",
					"method": "POST",
					"data": {
						nmtb: "tblmst_Merk",
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

		/*Get Data Ketegori */
		$(document).on('click', ".searchmerk", function() {
			var kode = $(this).attr("data-id");
			$.ajax({
				url: "<?= base_url('masterdata/Merk/DataMerk'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kodemerk').val(data[i].kode.trim());
					}
				}
			}, false);
		});



		/* Save */
		document.getElementById('save').addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var nama = $('#nama').val();
			var kodesatuan = $('#kodesatuan').val();
			var kodekategori = $('#kodekategori').val();
			var kodemerk = $('#kodemerk').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url("produk/Produk/Save") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						nama: nama,
						kodesatuan: kodesatuan,
						kodekategori: kodekategori,
						kodemerk: kodemerk,
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').prop('disabled', true);
							$('#nama').prop('disabled', true);
							$('#kodesatuan').prop('readonly', true);
							$('#kodekategori').prop('readonly', true);
							$('#kodemerk').prop('readonly', true);

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

		document.getElementById("find").addEventListener("click", function(event) {
			event.preventDefault();
			$('#tb_detail').empty();
			$('#t_barang').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": true,
				"pageLength": 5,
				"lengthMenu": [5, 10, 25, 50],
				"order": [],
				"ajax": {
					"url": "<?= base_url('produk/Produk/CariDataBarang'); ?>",
					"method": "POST",
					"data": {
						nmtb: "tblmst_product",
						field: {
							kode: "kode",
							nama: "nama",
							kodesatuan: "kodesatuan",
							kodekategori: "kodekategori",
							kodemerk: "kodemerk",
							// komisi: "komisi",
							aktif: "status"
						},
						sort: "kode",
						where: {
							kode: "kode"
						},
						// value: "aktif = true"
					},
				}
			});
		});

		$(document).on('click', ".searchbarang", function() {
			var kode = $(this).attr("data-id");
			GetData(kode);
			$('#save').prop('disabled', true);
			$('#update').prop('disabled', false);
		});

		function GetData(kode) {
			$.ajax({
				url: "<?= base_url('produk/Produk/DataBarang'); ?>",
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
						$('#kodesatuan').val(data[i].kodesatuan.trim());
						$('#kodekategori').val(data[i].kodekategori.trim());
						$('#kodemerk').val(data[i].kodemerk.trim());
						// $('#komisi').val(data[i].komisi.trim() + '%');
						if (data[i].status.trim() == 1) {
							$('#aktif').prop('checked', true);
						} else {
							$('#tidak_aktif').prop('checked', true);
						}
					}
					// GetDataDetail(kode);
					$('#update').prop('disabled', false);
					$('#save').prop('disabled', true);
					$('#kode').prop('disabled', true);

					$('#carisatuan').hide();
					$('.aktif').show();
				}
			});
		};



		/* Update */
		document.getElementById('update').addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var nama = $('#nama').val();
			var kodesatuan = $('#kodesatuan').val();
			var kodekategori = $('#kodekategori').val();
			var kodemerk = $('#kodemerk').val();
			var aktif = $('input[name="aktif"]:checked').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url("produk/Produk/Update") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						nama: nama,
						kodesatuan: kodesatuan,
						kodekategori: kodekategori,
						kodemerk: kodemerk,
						aktif: aktif
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').prop('disabled', true);
							$('#nama').prop('disabled', true);
							// $('#barcode1').prop('disabled', true);
							// $('#barcode2').prop('disabled', true);
							$('#kodesatuan').prop('readonly', true);
							$('#kodekategori').prop('readonly', true);
							$('#komisi').prop('disabled', true);
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
