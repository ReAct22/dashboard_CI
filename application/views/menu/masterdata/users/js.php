<script type="text/javascript">
	$(document).ready(function() {
		function clearscrean() {
			$('#save').prop('disabled', false);
			$('#update').prop('disabled', true);

			$('#login').val("").prop('disabled', false);
			$('#password').val("").prop('disabled', false);
			$('#group').val("");
			$('#kode_cabang').val("")
			$('#kode_gudang').val("")

			$('input[name="ho"]:checked').prop('checked', false);
			$('input[name="ho"]').prop('disabled', false);
			$('input[name="aktif"]:checked').prop('checked', false);

			$('#caricabang').show();
			$('#carigroup').show();
			$('#carigudang').show();
			$('.aktif').hide();
		};

		$('#caricabang').click(function() {
			$('#kode_gudang').val('');
		})

		$('input[name="ho"]').click(function() {
			if ($('input[name="ho"]:checked').val() == 'true') {
				$('#caricabang').hide();
				$('#carigudang').hide();
				$('#carigroup').hide();
				$('#group').val('HO2');
			} else {
				$('#caricabang').show();
				$('#carigudang').show();
				$('#carigroup').show();
				$('#group').val('');
			}
		})

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

		function validasiSave() {
			if ($('#login').val() == '') {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Username tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#login').focus();
				var result = false;
			} else if ($('#password').val() == '') {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Password tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#password').focus();
				var result = false;
			} else if ($('#group').val() == '') {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Grup tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#group').focus();
				var reslut = false;
			} else {
				var result = true;
			}
			return result
		};

		document.getElementById("carigroup").addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_group').DataTable({
				"destroy": true,
				"searching": true,
				"processinog": true,
				"serverSide": true,
				"lengthChange": false,
				"pageLength": 5,
				"order": [],
				"ajax": {
					"url": "<?php echo base_url('masterdata/User/CariDataGroup') ?>",
					"method": "POST",
					"data": {
						nmtb: "stpm_grup",
						field: {
							kode: "kode",
							nama: "nama"
						},
						sort: "kode",
						where: {
							kode: "kode",
							nama: "nama"
						},
						values: "aktif = true"
					},
				}
			});
		});

		$(document).on('click', ".searchgroup", function() {
			var kode = $(this).attr("data-id");
			$.ajax({
				url: "<?php echo base_url('masterdata/User/DataGroup') ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#group').val(data[i].kode.trim());
					}
				}
			});
		});

		document.getElementById("caricabang").addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_cabang').DataTable({
				"destroy": true,
				"searching": true,
				"processinog": true,
				"serverSide": true,
				"lengthChange": false,
				"pageLength": 5,
				"order": [],
				"ajax": {
					"url": "<?php echo base_url('masterdata/Cabang/CariDataCabang') ?>",
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
					},
				}
			});
		});

		$(document).on('click', ".searchcabang", function() {
			var kode = $(this).attr("data-id");
			$.ajax({
				url: "<?php echo base_url('masterdata/Cabang/DataCabang') ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kode_cabang').val(data[i].kode.trim());
					}
				}
			});
		});

		document.getElementById("carigudang").addEventListener("click", function(event) {
			event.preventDefault();
			var kodecabang = $('#kode_cabang').val();
			$('#t_gudang').DataTable({
				"destroy": true,
				"searching": true,
				"processinog": true,
				"serverSide": true,
				"lengthChange": false,
				"pageLength": 5,
				"order": [],
				"ajax": {
					"url": "<?php echo base_url('masterdata/Gudang/CariDataGudang') ?>",
					"method": "POST",
					"data": {
						nmtb: "tblmst_gudang",
						field: {
							kode: "kode",
							nama: "nama"
						},
						sort: "kode",
						where: {
							kode: "kode",
							nama: "nama"
						},
						value: "status = 1 AND kodecabang = '" + kodecabang + "'"
					},
				}
			});
		});

		$(document).on('click', ".searchgudang", function() {
			var kode = $(this).attr("data-id");
			$.ajax({
				url: "<?php echo base_url('masterdata/Gudang/DataGudang') ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					kode: kode
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#kode_gudang').val(data[i].kode.trim());
					}
				}
			});
		});

		document.getElementById("find").addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_user').DataTable({
				"destroy": true,
				"searching": true,
				"processinog": true,
				"serverSide": true,
				"lengthChange": false,
				"pageLength": 5,
				"order": [],
				"ajax": {
					"url": "<?php echo base_url('masterdata/User/CariDataUser') ?>",
					"method": "POST",
					"data": {
						nmtb: "stpm_login",
						field: {
							username: "username",
							grup: "grup",
							statusho: "statusho",
							kodecabang: "kodecabang",
							kodegudang: "kodegudang",
							aktif: "aktif"
						},
						sort: "username",
						where: {
							username: "username",
							grup: "grup",
							kodecabang: "kodecabang",
							kodegudang: "kodegudang"
						},
						value: "username <> 'superadmin'"
					},
				},
				"columnDefs": [{
                    "targets": 3,
                    "data": "statusho",
                    "render": function(data, type, row, meta) {
                        return (row[3] == 't') ? 'HO' : 'Bukan HO';
                    }
                },{
                    "targets": 6,
                    "data": "aktif",
                    "render": function(data, type, row, meta) {
                        return (row[6] == 't') ? 'Aktif' : 'Tidak Aktif';
                    }
                }
			],
			});
		});

		$(document).on('click', ".searchuser", function() {
			var username = $(this).attr("data-id");
			$.ajax({
				url: "<?php echo base_url('masterdata/User/DataUser') ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					username: username
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						$('#login').val(data[i].username.trim());
						$('#group').val(data[i].grup.trim());
						$('#kode_cabang').val(data[i].kodecabang.trim());
						$('#kode_gudang').val(data[i].kodegudang.trim());
						$('input[name="password"]').val(atob(data[i].password.trim()));
						if (data[i].statusho.trim() == 't') {
							$('#ho').prop('checked', true);
							$('#caricabang').hide();
							$('#carigudang').hide();
							$('#carigroup').hide();
						} else {
							$('#tidak_ho').prop('checked', true);
							$('#caricabang').show();
							$('#carigudang').show();
							$('#carigroup').show();
						}
						if (data[i].aktif.trim() == 't') {
							$('#aktif').prop('checked', true);
						} else {
							$('#tidak_aktif').prop('checked', true);
						}

					}
					$('#update').prop('disabled', false);
					$('#save').prop('disabled', true);
					$('#login').prop('disabled', true);
					$('.aktif').show();
				}
			}, false);
		});

		document.getElementById("save").addEventListener("click", function(event) {
			event.preventDefault();

			var username = $('#login').val();
			var user = username.toLowerCase();
			var password = $('#password').val();
			var grup = $('#group').val();
			var statusho = $('input[name="ho"]:checked').val();
			var kodecabang = $('#kode_cabang').val();
			var kodegudang = $('#kode_gudang').val();
			console.log(user);

			if (validasiSave() == true) {
				$.ajax({
					url: "<?php echo base_url('masterdata/User/Save') ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						username: username,
						password: password,
						grup: grup,
						statusho: statusho,
						kodecabang: kodecabang,
						kodegudang: kodegudang
					},
					success: function(data) {
						if (data.username != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#login').val(data.username).prop('disabled', true);
							$('#password').prop('disabled', true);
							$('#group').prop('disabled', true);
							$('#kode_cabang').prop('disabled', true)
							$('#kode_gudang').prop('disabled', true)

							$('input[name="ho"]').prop('disabled', true);
						} else {
							Toast.fire({
								icon: 'error',
								title: data.message
							});
						}
					}
				});
			}
		});

		document.getElementById("update").addEventListener("click", function(event) {
			event.preventDefault();

			var username = $('#login').val();
			var password = $('#password').val();
			var grup = $('#group').val();
			var statusho = $('input[name="ho"]:checked').val();
			var kodecabang = $('#kode_cabang').val();
			var kodegudang = $('#kode_gudang').val();
			var aktif = $('input[name="aktif"]:checked').val();

			if (validasiSave() == true) {
				$.ajax({
					url: "<?php echo base_url('masterdata/User/Update') ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						username: username,
						password: password,
						grup: grup,
						statusho: statusho,
						kodecabang: kodecabang,
						kodegudang: kodegudang,
						aktif: aktif
					},
					success: function(data) {
						if (data.username != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#login').val(data.username).prop('disabled', true);
							$('#password').prop('disabled', true);
							$('#group').prop('disabled', true);
							$('#kode_cabang').prop('disabled', true)
							$('#kode_gudang').prop('disabled', true)

							$('input[name="ho"]').prop('disabled', true);
						} else {
							Toast.fire({
								icon: 'error',
								title: data.message
							});
						}
					}
				});
			}
		});

		document.getElementById("clear").addEventListener("click", function(event) {
			event.preventDefault();
			clearscrean()
		});

		clearscrean();


	});
</script>
