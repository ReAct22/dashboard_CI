<script type="text/javascript">
	$(document).ready(function() {

		/* Function ClearScreen */
		function ClearScreen() {
			$('#kode').prop('disabled', false).val("");
			$('#namaperusahaan').prop('disabled', false).val("");
			$('#alamat').prop('disabled', false).val("");
			$('#namanpwp').prop('disabled', false).val("");
			$('#npwp').prop('disabled', false).val("");
			$('#alamatnpwp').prop('disabled', false).val("");
			$('#ppn').prop('disabled', false).val("");
			$('#disccash').prop('disabled', false).val("");
			$('#disccod').prop('disabled', false).val("");
			$('#alamatcek').prop('checked', false);
			$('#alamatcek').prop('disabled', false);

			$('input[name="statuspkp"]:checked').prop('checked', false);
			$('input[name="nourut"]:checked').prop('checked', false);
			$('input[name="backdate"]:checked').prop('checked', false);
			$('input[type="radio"]').prop('disabled', false);

			$('#npwp').mask('00.000.000.0-000.000', {
				placeholder: "00.000.000.0-000.000"
			});

			$('#update').prop('disabled', true);
			$('#save').prop('disabled', false);
			$('.nourut').hide();
		};


		$('input[name="statuspkp"]').change(function() {
			var statuspkp = $('input[name="statuspkp"]:checked').val();
			if (statuspkp == 'true') {
				$('.nourut').show();
			} else {
				$('.nourut').hide();
			}
		})

		$('#ppn').mask('99.99%', {
			reverse: true
		});

		$('#disccash').mask('99.99%', {
			reverse: true
		});

		$('#disccod').mask('99.99%', {
			reverse: true
		});

		function AlamatSama() {
			if ($("#alamatcek").is(":checked")) {
				$('#alamatnpwp').val($('#alamat').val());
				$('#alamatnpwp').prop("disabled", true);
			} else {
				$('#alamatnpwp').prop("disabled", false).val("");
			}
		}

		$('#alamatcek').click(function() {
			AlamatSama();
		})

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
		// function DeFormatRupiah(angka) {
		//     var result = angka.replace(/[^\w\s]/gi, '');

		//     return result;
		// };

		/* Validasi Kosong */
		function ValidasiSave() {
			var kode = $('#kode').val();
			var namaperusahaan = $('#namaperusahaan').val();
			var alamat = $('#alamat').val();
			var namanpwp = $('#namanpwp').val();
			var alamatnpwp = $('#alamatnpwp').val();
			var npwp = $('#npwp').val();
			var ppn = $('#ppn').val();
			var disccash = $('#disccash').val();
			var disccod = $('#disccod').val();

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
			} else if (namaperusahaan == '' || namaperusahaan == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Nama Perusahaan tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#namaperusahaan').focus();
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
			} else if (namanpwp == '' || namanpwp == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'NPWP tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#namanpwp').focus();
				var result = false;
				// } else if (alamatnpwp == '' || alamatnpwp == 0) {
				// 	Swal.fire({
				// 		title: 'Informasi',
				// 		icon: 'info',
				// 		html: 'Alamat NPWP tidak boleh kosong.',
				// 		showCloseButton: true,
				// 		width: 350,
				// 	});
				// 	$('#alamatnpwp').focus();
				// 	var result = false;
			} else if (npwp == '' || npwp == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'NPWP tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#npwp').focus();
				var result = false;
			} else if (ppn == '' || ppn == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'PPN tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#ppn').focus();
				var result = false;
			} else if (disccash == '' || disccash == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Disc. Cash tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#disccash').focus();
				var result = false;
			} else if (disccod == '' || disccod == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Disc. COD tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#disccod').focus();
				var result = false;
			} else if (ppn > 100) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'PPN tidak boleh lebih dari sama dengan 100.',
					showCloseButton: true,
					width: 350,
				});
				$('#ppn').focus();
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
			var namaperusahaan = $('#namaperusahaan').val();
			var alamat = $('#alamat').val();
			var namanpwp = $('#namanpwp').val();
			var alamatnpwp = $('#alamatnpwp').val();
			var npwp = $('#npwp').val();
			var ppn = $('#ppn').val();
			var disccash = $('#disccash').val();
			var disccod = $('#disccod').val();
			var statuspkp = $('input[name="statuspkp"]:checked').val();
			var nourut = $('input[name="nourut"]:checked').val();
			var backdate = $('input[name="backdate"]:checked').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url("masterdata/Konfigurasi/Save") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						namaperusahaan: namaperusahaan,
						alamat: alamat,
						statuspkp: statuspkp,
						npwp: npwp,
						namanpwp: namanpwp,
						alamatnpwp: alamatnpwp,
						ppn: ppn,
						disccash: disccash,
						disccod: disccod,
						nourut: nourut,
						backdate: backdate,
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').val(data.kode).prop('disabled', true)
							$('#namaperusahaan').prop('disabled', true);
							$('#alamat').prop('disabled', true);
							$('#npwp').prop('disabled', true);
							$('#namanpwp').prop('disabled', true);
							$('#alamatnpwp').prop('disabled', true);
							$('#ppn').prop('disabled', true);
							$('#disccash').prop('disabled', true);
							$('#disccod').prop('disabled', true);
							$('#alamatcek').prop('disabled', true);
							$('input[name="statuspkp"]').prop('disabled', true);
							$('input[name="nourut"]').prop('disabled', true);
							$('input[name="backdate"]').prop('disabled', true);

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

		$(document).on('click', ".searchkonfigurasi", function() {
			var kode = $(this).attr("data-id");
			GetData(kode);
			$('#save').prop('disabled', true);
			$('#update').prop('disabled', false);
		});

		function GetData() {
			$.ajax({
				url: "<?= base_url('masterdata/Konfigurasi/CekDataKonfigurasi'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {

				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kode').val(data[i].kode.trim());
						$('#namaperusahaan').val(data[i].namaperusahaan.trim());
						$('#alamat').val(data[i].alamatperusahaan.trim());
						$('#npwp').val(data[i].npwp.trim());
						$('#namanpwp').val(data[i].namanpwp.trim());
						$('#alamatnpwp').val(data[i].alamatnpwp.trim());
						$('#ppn').val(data[i].ppn.trim() + '%');
						$('#disccash').val(data[i].disccash.trim() + '%');
						$('#disccod').val(data[i].disccod.trim() + '%');

						if (data[i].pkp.trim() == '1') {
							$('#yes').prop('checked', true);
							$('.nourut').show();
						} else {
							$('#no').prop('checked', true);
							$('.nourut').show();
						}

						if ($('#alamat').val() == $('#alamatnpwp').val()) {
							$('#alamatnpwp').prop('disabled', true);
							$('#alamatcek').prop('checked', true);
						} else {
							$('#alamatnpwp').prop('disabled', false);
							$('#alamatcek').prop('checked', false);
						}

						if (data[i].nourut.trim() == '1') {
							$('#yesurut').prop('checked', true);
						} else {
							$('#nourut').prop('checked', true);
						}
						if (data[i].backdate.trim() == '1') {
							$('#yesbd').prop('checked', true);
						} else {
							$('#nobd').prop('checked', true);
						}
					}
					if (data = "") {
						$('#update').prop('disabled', true);
						$('#save').show();
					} else {
						$('#update').prop('disabled', false);
						$('#save').hide();
					}
				}
			});
		};



		/* Update */
		document.getElementById('update').addEventListener("click", function(event) {
			event.preventDefault();
			var kode = $('#kode').val();
			var namaperusahaan = $('#namaperusahaan').val();
			var alamat = $('#alamat').val();
			var namanpwp = $('#namanpwp').val();
			var alamatnpwp = $('#alamatnpwp').val();
			var npwp = $('#npwp').val();
			var ppn = $('#ppn').val();
			var disccash = $('#disccash').val();
			var disccod = $('#disccod').val();
			var statuspkp = $('input[name="statuspkp"]:checked').val();
			var nourut = $('input[name="nourut"]:checked').val();
			var backdate = $('input[name="backdate"]:checked').val();

			if (ValidasiSave() == true) {
				$.ajax({
					url: "<?= base_url("masterdata/Konfigurasi/Update") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						kode: kode,
						namaperusahaan: namaperusahaan,
						alamat: alamat,
						statuspkp: statuspkp,
						npwp: npwp,
						namanpwp: namanpwp,
						alamatnpwp: alamatnpwp,
						ppn: ppn,
						disccash: disccash,
						disccod: disccod,
						nourut: nourut,
						backdate: backdate
					},
					success: function(data) {
						if (data.kode != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').val(data.kode).prop('disabled', true);
							$('#namaperusahaan').prop('disabled', true);
							$('#alamat').prop('disabled', true);
							$('#npwp').prop('disabled', true);
							$('#namanpwp').prop('disabled', true);
							$('#alamatnpwp').prop('disabled', true);
							$('#ppn').prop('disabled', true);
							$('#disccash').prop('disabled', true);
							$('#disccod').prop('disabled', true);
							$('#alamatcek').prop('disabled', true);
							$('input[name="statuspkp"]').prop('disabled', true);
							$('input[name="nourut"]').prop('disabled', true);
							$('input[name="backdate"]').prop('disabled', true);

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

		/* Clear */
		document.getElementById("clear").addEventListener("click", function(event) {
			event.preventDefault();
			ClearScreen();
		})

		ClearScreen();
		GetData();
	})
</script>
