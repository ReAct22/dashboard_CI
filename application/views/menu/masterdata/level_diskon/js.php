<script>
	$(document).ready(function() {
		function ClearScreen() {
			$('#kode').prop('disabled', false).val("");
			$('#diskon').prop('disabled', false).val("");
			$('#kondisi1').prop('disabled', false).val("");
			$('#kondisi2').prop('disabled', false).val("");

			$('#kodecabang').prop('disabled', false).val("J");
			$('#namacabang').prop('disabled', false).val("");
			$('#kodebarang').prop('disabled', false).val("");
			$('#namabarang').prop('disabled', false).val("");
			$('#noreferensi').prop('disabled', false).val("");
			$('#aktif').prop('disabled', false);

			$('#update').prop('disabled', true).val("");
			$('#save').prop('disabled', false).val("");

			$('.aktif').hide();
		}

		/* Format Rupiah */
		function FormatRupiah(angka, prefix) {
			if (!angka) {
				return '';
			}
			var vangka = angka.toString();
			var number_string = vangka.replace(/[^.\d]/g, '').replace(/[^\w\s]/gi, '').toString(),
				split = number_string.split('.'),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if (ribuan) {
				separator = sisa ? ',' : '';
				rupiah += separator + ribuan.join(',');
			}

			rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
		};

		/* DeFormat Rupiah */
		function DeFormatRupiah(angka) {
			var result = angka.replace(/[^\w\s]/gi, '');

			return result;
		};

		$('#diskon').mask('99.99%', {
			reverse: true
		});
		$('#kondisi1').keyup(function() {
			$(this).val(FormatRupiah($(this).val()));
		})
		$('#kondisi2').keyup(function() {
			$(this).val(FormatRupiah($(this).val()));
		})

		function ValidasiSave() {
			// var kode = $('#kode').val();
			var diskon = $('#diskon').val();
			var kondisi1 = $('#kondisi1').val();
			var kondisi2 = $('#kondisi2').val();
			var kodecabang = $('#kodecabang').val();
			var namacabang = $('#namacabang').val();
			var kodebarang = $('#kodebarang').val();
			var namabarang = $('#namabarang').val();

			// if (kode == '' || kode == 0) {
			// 	Swal.fire({
			// 		title: 'Informasi',
			// 		icon: 'info',
			// 		html: 'Kode tidak boleh kosong.',
			// 		showCloseButton: true,
			// 		width: 350
			// 	});
			// 	$('#kode').focus();
			// 	var result = false;
			// } else 
			if (kodecabang == '' || kodecabang == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kode Cabang tidak boleh kosong.',
					showCloseButton: true,
					width: 350
				});
				$('#kodecabang').focus();
				var result = false;
			} else if (namacabang == '' || namacabang == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Nama Cabang tidak boleh kosong.',
					showCloseButton: true,
					width: 350
				});
				$('#namacabang').focus();
				var result = false;
			} else if (kodebarang == '' || kodebarang == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kode Barang tidak boleh kosong.',
					showCloseButton: true,
					width: 350
				});
				$('#kodebarang').focus();
				var result = false;
			} else if (namabarang == '' || namabarang == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Nama Barang tidak boleh kosong.',
					showCloseButton: true,
					width: 350
				});
				$('#namabarang').focus();
				var result = false;
			} else if (diskon == '' || diskon == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Diskon tidak boleh kosong.',
					showCloseButton: true,
					width: 350
				});
				$('#diskon').focus();
				var result = false;
			} else if (kondisi1 == '' || kondisi1 == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kondisi 1 tidak boleh kosong.',
					showCloseButton: true,
					width: 350
				});
				$('#kondisi1').focus();
				var result = false;
			} else if (kondisi2 == '' || kondisi2 == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'kondisi 2 tidak boleh kosong.',
					showCloseButton: true,
					width: 350
				});
				$('#kondisi2').focus();
				var result = false;
			} else if (Number(kondisi2) <= Number(kondisi1)) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kondisi 2 Tidak boleh kurang dari sama dengan kondisi 1.',
					showCloseButton: true,
					width: 350
				});
				$('#kondisi2').focus();
				var result = false;
			} else if (diskon > 100) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Diskon tidak boleh lebih dari 100.',
					showCloseButton: true,
					width: 350
				});
				$('#kondisi2').focus();
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

		document.getElementById('caricabang').addEventListener("click", function(event) {
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
							nama: "nama"
						},
						sort: "kode",
						where: {
							kode: "kode",
							nama: "nama"
						},
						value: "status = 1"
					},
				}
			});
		});

		$(document).on('click', ".searchcabang", function() {
			var kode = $(this).attr("data-id");
			$.ajax({
				url: "<?= base_url('masterdata/Cabang/DataCabang') ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kodecabang').val(data[i].kode.trim());
						// $('#namacabang').val(data[i].nama.trim());
					}
				}
			}, false);
		});
		document.getElementById('carigroup').addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_group').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": true,
				"pageLength": 5,
				"lengthMenu": [5, 10, 25, 50],
				"order": [],
				"ajax": {
					"url": "<?= base_url('masterdata/GrupCustomer/CariDataGrupCustomer'); ?>",
					"method": "POST",
					"data": {
						nmtb: "glbm_grupcustomer",
						field: {
							kode: "kode",
							nama: "nama"
						},
						sort: "kode",
						where: {
							kode: "kode",
							nama: "nama"
						},
						value: "status = true"
					},
				}
			});
		});

		$(document).on('click', ".searchgrupcustomer", function() {
			var kode = $(this).attr("data-id");
			$.ajax({
				url: "<?= base_url('masterdata/GrupCustomer/DataGrupCustomer') ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#noreferensi').val(data[i].kode.trim());
						// $('#namacabang').val(data[i].nama.trim());
					}
				}
			}, false);
		});

		document.getElementById('caribarang').addEventListener("click", function(event) {
			event.preventDefault();
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
						},
						sort: "kode",
						where: {
							kode: "kode",
							nama: "nama",
						},
						value: "status = 1"
					},
				}
			});
		});

		$(document).on('click', ".searchbarang", function() {
			var kode = $(this).attr("data-id");
			$.ajax({
				url: "<?= base_url('produk/Produk/DataBarang') ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kodebarang').val(data[i].kode.trim());
						$('#namabarang').val(data[i].nama.trim());
					}
				}
			});
		});

		document.getElementById('save').addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var diskon = $('#diskon').val();
			var kondisi1 = $('#kondisi1').val();
			var kondisi2 = $('#kondisi2').val();
			var kodecabang = $('#kodecabang').val();
			var noreferensi = $('#noreferensi').val();
			var kodebarang = $('#kodebarang').val();
			var namabarang = $('#namabarang').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url('masterdata/LevelDiskon/Save') ?>",
					method: "POST",
					dataType: "json",
					async: false,
					data: {
						kode: kode,
						diskon: diskon,
						kondisi1: kondisi1,
						kondisi2: kondisi2,
						kodecabang: kodecabang,
						noreferensi: noreferensi,
						kodebarang: kodebarang,
						namabarang: namabarang
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							setInterval();
							$('#kode').val(data.kode);
							$('#diskon').prop('disabled', true);
							$('#kondisi1').prop('disabled', true);
							$('#kondisi2').prop('disabled', true);

							$('#update').prop("disabled", true);
							$('#save').prop("disabled", true);
						} else {
							Toast.fire({
								icon: 'error',
								title: data.message
							});
						}
					}

				}, false);
			}
		});

		var tableDiskon = $('#t_detail').DataTable({
			"destroy": true,
			"searching": true,
			"serverSide": true,
			"lengthChange": true,
			"pageLength": 5,
			"lengthMenu": [5, 10, 25, 50],
			"order": [],
			"ajax": {
				"url": "<?= base_url('masterdata/LevelDiskon/CariDataDiskon'); ?>",
				"method": "POST",
				"data": {
					nmtb: "tblmst_leveldiskon",
					field: {
						kode: "kode",
						noreferensi: "noreferensi",
						kodebarang: "kodebarang",
						namabarang: "namabarang",
						diskon: "diskon",
						kondisi1: "kondisi1",
						kondisi2: "kondisi2",
						status: "status"
					},
					sort: "kode",
					where: {
						kode: "kode",
						kodebarang: "kodebarang",
						namabarang: "namabarang",
					},
					// value: "kodecabang = '" + $('#cabang').val() + "'"
					// value: "kodecabang = '" + $('#cabang').val() + "' "
				},
			},
			"columnDefs": [{
					"targets": 5,
					"data": "diskon",
					"render": function(data, type, row, meta) {
						return row[5] + '%';
					}
				}, {
					"targets": 6,
					"data": "kondisi1",
					"render": function(data, type, row, meta) {
						return FormatRupiah(row[6]);
					}
				}, {
					"targets": 7,
					"data": "kondisi2",
					"render": function(data, type, row, meta) {
						return FormatRupiah(row[7]);
					}
				},
				{
					"targets": 8,
					"data": "status",
					"render": function(data, type, row, meta) {
						return (row[8] == '1') ? 'Aktif' : 'Tidak Aktif';
					}
				}
			],
		});

		setInterval(function() {
			tableDiskon.ajax.reload(null, false); // user paging is not reset on reload
		}, 3000);

		$(document).on('click', ".searchdiskon", function() {
			var kode = $(this).attr("data-id");
			$.ajax({
				url: "<?= base_url('masterdata/LevelDiskon/DataDiskon') ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kode').val(data[i].kode.trim());
						$('#kodecabang').val(data[i].kodecabang.trim());
						$('#noreferensi').val(data[i].noreferensi.trim());
						$('#kodebarang').val(data[i].kodebarang.trim());
						$('#namabarang').val(data[i].namabarang.trim());
						$('#diskon').val(data[i].diskon.trim());
						$('#kondisi1').val(FormatRupiah(data[i].kondisi1.trim()));
						$('#kondisi2').val(FormatRupiah(data[i].kondisi2.trim()));
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
			});
		})

		document.getElementById("update").addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var diskon = $('#diskon').val();
			var kondisi1 = $('#kondisi1').val();
			var kondisi2 = $('#kondisi2').val();
			var kodecabang = $('#kodecabang').val();
			var noreferensi = $('#noreferensi').val();
			var kodebarang = $('#kodebarang').val();
			var namabarang = $('#namabarang').val();
			var aktif = $('input[name="aktif"]:checked').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url('masterdata/LevelDiskon/Update') ?>",
					method: "POST",
					dataType: "json",
					async: false,
					data: {
						kode: kode,
						diskon: diskon,
						kondisi1: kondisi1,
						kondisi2: kondisi2,
						kodecabang: kodecabang,
						noreferensi: noreferensi,
						kodebarang: kodebarang,
						namabarang: namabarang,
						aktif: aktif
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							setInterval();
							$('#kode').val(data.kode);
							$('#diskon').prop('disabled', true);
							$('#kondisi1').prop('disabled', true);
							$('#kondisi2').prop('disabled', true);
							$('input[name="aktif"]').prop('disabled', true);

							$('#update').prop("disabled", true);
							$('#save').prop("disabled", true);
						} else {
							Toast.fire({
								icon: 'error',
								title: data.message
							});
						}
					}

				}, false);
			}
		});

		document.getElementById('clear').addEventListener("click", function(event) {
			event.preventDefault();
			ClearScreen();
		});

		ClearScreen();
	});
</script>
