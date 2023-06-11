
<script>
	$(document).ready(function() {
		function ClearScreen() {
			// $('#kode').prop('disabled', false).val("");
			$('#kodekategori').prop('disabled', false).val("");
			$('#kodemerk').prop('disabled', false).val("");
			$('#diskon').prop('disabled', false).val("");

			$('#save').prop('disabled', false);
			$('#update').prop('disabled', true);
			$('#aktif').prop('disabled', false);
			$('.aktif').hide();
			$('#tb_detail').empty();
			$('#carikategori').show();
			$('#carimerk').show();
		}

		$('#diskon').mask('99.99%', {
			reverse: true
		});

		function ValidasiSave(datadetail) {
			// var kode = $('#kode').val();
			var kodekategori = $('#kodekategori').val();
			// var kodemerk = $('#kodemerk').val();
			var diskon = $('#diskon').val();
			if (kodekategori == "" || kodekategori == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'icon',
					html: 'Nomor Pelanggan tidak boleh kosong',
					showCloseButton: true,
					width: 350,
				});
				$('#kodekategori').focus();
				var result = false;
			}
			else if (diskon == "" || diskon == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'icon',
					html: 'diskon tidak boleh kosong',
					showCloseButton: true,
					width: 350,
				});
				$('#diskon').focus();
				var result = false;
			} else if (datadetail.length == 0 || datadetail.length == '0') {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Data Detail tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#namagudang').focus();
				result = false;
			} else {
				var result = true
			}
			return result
		}

		/* Validasi Data Add Detail */
		function ValidasiAddDetail(kodemerk) {
			var table = document.getElementById('t_detail');
			var kodemerk = $('#kodemerk').val();
			var namamerk = $('#namamerk').val();

			if (kodemerk == '' || kodemerk == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Kode Merk tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#kodemerk').focus();
				return "gagal";
			} else if (namamerk == '' || namamerk == 0) {
				Swal.fire({
					title: 'Informasi',
					icon: 'info',
					html: 'Nama Merk tidak boleh kosong.',
					showCloseButton: true,
					width: 350,
				});
				$('#namamerk').focus();
				return "gagal";
			} else {
				for (var r = 1, n = table.rows.length; r < n; r++) {
					var string = "";
					for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
						if (c == 0) {
							if (table.rows[r].cells[c].innerHTML == kodemerk) {
								Swal.fire({
									title: 'Informasi',
									icon: 'info',
									html: 'Data ini sudah diinput.',
									showCloseButton: true,
									width: 350,
								});
								return "gagal";
							}
						}
					}
				}
			}
			return "sukses"
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

		$("#adddetail").click(function() {

			var kodemerk = $('#kodemerk').val();
			var namamerk = $('#namamerk').val();
			if (ValidasiAddDetail(kodemerk) == "sukses") {
				var row = "";
				row =
					'<tr id="' + kodemerk + '">' +
					'<td>' + kodemerk + '</td>' +
					'<td>' + namamerk + '</td>' +
					'<td style="text-align: center; width: 200px;">' +
					// '<button data-table="' + kodebarang + '" data-toggle="modal" data-target="#changediskon" class="editdetail btn btn-success m-1 p-1"><i class="fas fa-edit"></i> Edit</button>' +
					'<button data-table="' + kodemerk + '" class="deldetail btn btn-danger m-1 p-1"><i class="fa fa-trash mr-1"></i> Delete</button>' +
					'</td>' +
					'</tr>';
				$('#tb_detail').append(row);
				$('#kodemerk').val("");
				$('#namamerk').val("");
			}
		});

		$(document).on('click', '.editdetail', function() {
			var table = document.getElementById('t_detail');
			var tr = document.getElementById($(this).attr("data-table"));
			var td = tr.getElementsByTagName("td");
			for (var c = 0, m = table.rows[0].cells.length; c < m - 1; c++) {
				var chgth = table.rows[0].cells[c].innerHTML.replace(/ /g, '').replace(/\s/g, '').toLowerCase();
				var valuetd = td[c].innerHTML;
				$('#chg' + chgth).val(valuetd);
			}
		});

		$(document).on('click', '#changedetail', function() {
			// var kode = $('#chgkode').val();
			var kodebarang = $('#chgkode').val();
			// var namabarang = $('#chgnama').val();
			$('#' + kodebarang).remove();
			InsertDataDetail(kodebarang);
		});

		$(document).on('click', '.deldetail', function() {
			var id = $(this).attr("data-table");
			$('#' + id).remove();
		});

		function AmbilDataDetail() {
			var table = document.getElementById('t_detail');
			var arr2 = [];
			for (var r = 1, n = table.rows.length; r < n; r++) {
				var string = "";
				for (var c = 0, m = table.rows[r].cells.length; c < m - 1; c++) {
					if (c == 0) {
						string = "{" + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
					} else {
						string = string + ", " + table.rows[0].cells[c].innerHTML + " : '" + table.rows[r].cells[c].innerHTML + "'";
					}
				}
				string = string + "}";
				var obj = JSON.stringify(eval('(' + string + ')'));
				var arr = $.parseJSON(obj);
				arr2.push(arr);
			}
			return arr2;
		};

		function GetDataDetail(nomorpelanggan) {
			$.ajax({
				url: "<?= base_url('masterdata/DiscKhususPelanggan/DataDiscKhususPelangganDetail'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					nomorpelanggan: nomorpelanggan
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						// var kode = data[i].kode;
						var kodemerk = data[i].kodemerk;
						var namamerk = data[i].namamerk.trim();

						InsertDataDetail(kodemerk, namamerk);
					}
				}
			});
		};

		function InsertDataDetail(kodemerk, namamerk) {

			var row = "";
			row =
				'<tr id="' + kodemerk + '">' +
				'<td>' + kodemerk + '</td>' +
				'<td>' + namamerk + '</td>' +
				'<td style="text-align: center; width: 200px;">' +
				// '<button data-table="' + kodebarang + '" data-toggle="modal" data-target="#changediskon" class="editdetail btn btn-success m-1 p-1"><i class="fas fa-edit"></i> Edit</button>' +
				'<button data-table="' + kodemerk + '" class="deldetail btn btn-danger m-1 p-1"><i class="fa fa-trash mr-1"></i> Delete</button>' +
				'</td>' +
				'</tr>';
			$('#tb_detail').append(row);
		};

		/* Cari Data Satuan*/
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
						$('#kodekategori').val(data[i].kode.trim());
					}
				}
			}, false);
		});

		/* Cari Data Satuan*/
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
						nmtb: "tblmst_merk",
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

		/*Get Data Satuan */
		$(document).on('click', ".searchmerk", function() {
			var kode = $(this).attr("data-id");;
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
						$('#namamerk').val(data[i].nama.trim());
					}
				}
			}, false);
		});

		/* Cari Data Satuan*/
		document.getElementById("find").addEventListener("click", function(event) {
			event.preventDefault();
			$('#t_find').DataTable({
				"destroy": true,
				"searching": true,
				"processing": true,
				"serverSide": true,
				"lengthChange": true,
				"pageLength": 5,
				"lengthMenu": [5, 10, 25, 50],
				"order": [],
				"ajax": {
					"url": "<?= base_url('masterdata/DiscKhususPelanggan/CariDataDiscKhusus'); ?>",
					"method": "POST",
					"data": {
						nmtb: "glbm_discpelanggankategori",
						field: {
							// kode: "kode",
							nopelanggan: "nopelanggan",
							diskon: "diskon",
							aktif: "aktif",
							// qtysatuan: "qtysatuan",
							// konversi: "konversi",
						},
						sort: "nopelanggan",
						where: {
							nopelanggan: "nopelanggan"
						}
					},
				},
				'columnDefs': [{
					"targets": 3,
					"data": "aktif",
					"render": function(data, type, row, meta) {
						return (row[3] == "t") ? "<p>Aktif</p>" : "<p>Tidak Aktif</p>"
					}
				}]
			});
		});

		/*Get Data Satuan */
		$(document).on('click', ".searchdiscpelanggan", function() {
			var nomorpelanggan = $(this).attr("data-id");;
			$.ajax({
				url: "<?= base_url('masterdata/DiscKhususPelanggan/DataDisckKhususPelanggan'); ?>",
				method: "POST",
				dataType: "json",
				async: false,
				data: {
					nomorpelanggan: nomorpelanggan
				},
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						// $('#kode').val(data[i].kode.trim());
						$('#nomorpelanggan').val(data[i].nopelanggan.trim());
						// $('#kodemerk').val(data[i].kodemerk.trim());
						$('#diskon').val(data[i].diskon.trim() + '%');
					}
					GetDataDetail(nomorpelanggan);
					$('#nomorpelanggan').prop('disabled', false);
					$('#update').prop('disabled', false);
					$('#save').prop('disabled', true);
				}
			}, false);
		});

		/* Save */
		document.getElementById('save').addEventListener("click", function(event) {
			event.preventDefault();
			// var kode = $('#kode').val();
			var nomorpelanggan = $('#nomorpelanggan').val();
			var kodemerk = $('#kodemerk').val();
			var diskon = $('#diskon').val();
			var datadetail = AmbilDataDetail();

			if (ValidasiSave(datadetail) == true) {
				$.ajax({
					url: "<?= base_url("masterdata/DiscKhususPelanggan/Save") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						// kode: kode,
						nomorpelanggan: nomorpelanggan,
						kodemerk: kodemerk,
						diskon: diskon,
						datadetail: datadetail
					},
					success: function(data) {
						if (data.nomorpelanggan != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').prop('disabled', true)
							$('#nomorpelanggan').prop('disabled', true)
							$('#kodemerk').prop('disabled', true)
							$('#diskon').prop('disabled', true)

							$('#update').prop("disabled", true);
							$('#save').prop("disabled", true);

							$('#caripelanggan').hide();
							$('#carimerk').hide();
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

		/* Save */
		document.getElementById('update').addEventListener("click", function(event) {
			event.preventDefault();
			// var kode = $('#kode').val();
			var nomorpelanggan = $('#nomorpelanggan').val();
			var kodemerk = $('#kodemerk').val();
			var diskon = $('#diskon').val();
			var aktif = $('input[name="aktif"]:checked').val();
			var datadetail = AmbilDataDetail();

			if (ValidasiSave(datadetail) == true) {
				$.ajax({
					url: "<?= base_url("masterdata/DiscKhususPelanggan/Update") ?>",
					method: "POST",
					dataType: "json",
					async: true,
					data: {
						// kode: kode,
						nomorpelanggan: nomorpelanggan,
						kodemerk: kodemerk,
						diskon: diskon,
						aktif: aktif,
						datadetail: datadetail
					},
					success: function(data) {
						if (data.nomorpelanggan != "") {
							Toast.fire({
								icon: 'success',
								title: data.message
							});
							$('#kode').prop('disabled', true);
							$('#nomorpelanggan').prop('disabled', true);
							$('#kodemerk').prop('disabled', true);
							$('#diskon').prop('disabled', true);
							$('#aktif').prop('disabled', true);

							$('#update').prop("disabled", true);
							$('#save').prop("disabled", true);

							$('#caripelanggan').hide();
							$('#carimerk').hide();
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

		document.getElementById('clear').addEventListener("click", function(event) {
			event.preventDefault();
			ClearScreen();
		})

		ClearScreen();
	});
</script>
