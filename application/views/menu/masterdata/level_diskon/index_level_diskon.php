<div class="col-xl-12 mb-2">
	<div class="modal-header" style="padding: 5px;">
		<div class="col-xl-12">
			<div class="row">
				<div class="col-md-5">
					<h2>
						<span class="logo-menu"><?= $icons ?></span>
						<span class="text-uppercase"><?= $title ?></span>
					</h2>
				</div>
				<div class="col-md-7">
					<div class="form-group" style="float: right;">
						<button id="save" class="btn btn-sm btn-dark mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-save" style="margin-right: 10px;"></i>Save</button>
						<button id="update" class="btn btn-sm btn-dark mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-money-check-edit" style="margin-right: 10px;"></i>Update</button>
						<button id="clear" class="btn btn-sm btn-dark mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-refresh" style="margin-right: 10px;"></i>Clear</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-12 table-responsive hidescroll" style="height: 555px; overflow-y: scroll;">
	<div class="row">
		<div class="col-12 col-md-12 col-lg-12 col-xl-12">
			<div class="modal-content mb-2">
				<div class="modal-body">
					<div class="row mb-2 mt-2">
						<div class="col-sm-12 input-group">
							<div class="col-sm-3 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Kode Diskon</span>
							</div>
							<input class="col-sm-3 form-control" type="text" name="kode" id="kode" maxlength="50" placeholder="Kode Diskon" required readonly />
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Kode Cabang</span>
							</div>
							<input class="form-control" type="text" name="kodecabang" id="kodecabang" maxlength="50" placeholder="Kode Cabang" readonly required />
							<div class="input-group-text btn-dark" data-toggle="modal" data-target="#findcabang" id="caricabang">
								<span class="input-group-addon">
									<i class="fa fa-search text-white"></i>
								</span>
							</div>
						</div>
						<!-- <div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Nama Cabang</span>
							</div>
							<input class="form-control" type="text" name="namacabang" id="namacabang" maxlength="50" placeholder="Nama Cabang" readonly required />
						</div> -->
					</div>
					<div class="row mb-2">
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Kode Barang</span>
							</div>
							<input class="form-control" type="text" name="kodebarang" id="kodebarang" maxlength="50" placeholder="Kode Barang" readonly required />
							<div class="input-group-text btn-dark" data-toggle="modal" data-target="#findbarang" id="caribarang">
								<span class="input-group-addon">
									<i class="fa fa-search text-white"></i>
								</span>
							</div>
						</div>
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Nama Barang</span>
							</div>
							<input class="form-control" type="text" name="namabarang" id="namabarang" maxlength="50" placeholder="Nama Barang" readonly required />
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12 col-lg-12 col-xl 6">
			<div class="modal-content mb-2">
				<div class="modal-body">
					<div class="row mb-2 mt-2">
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Diskon(%)</span>
							</div>
							<input class="form-control" type="text" name="diskon" id="diskon" max="9999" placeholder="Diskon" required />
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Kondisi 1 >= </span>
							</div>
							<input class="form-control" type="text" name="kondisi1" id="kondisi1" maxlength="50" placeholder="Quantity" required />
						</div>
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Kondisi 2 <= </span>
							</div>
							<input class="form-control" type="text" name="kondisi2" id="kondisi2" maxlength="50" placeholder="Quantity" required />
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">No Referensi </span>
							</div>
							<input class="form-control" type="text" name="noreferensi" id="noreferensi" maxlength="50" placeholder="No Referensi" />
							<div class="input-group-text btn-dark" data-toggle="modal" data-target="#findgroup" id="carigroup">
								<span class="input-group-addon">
									<i class="fa fa-search text-white"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="row mb-2 mb-2 aktif">
						<div class="col-sm-6 input-group">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Status Aktif</span>
							</div>
							<div class="input-group-text">
								<label class="radio radio-dark mb-0 mr-1 ml-1">
									<input type="radio" name="aktif" id="aktif" value="1"><span>YES</span><span class="checkmark"></span>
								</label>
								<label class="radio radio-dark mb-0 mr-1 ml-1">
									<input type="radio" name="aktif" id="tidak_aktif" value="0"><span>NO</span><span class="checkmark"></span>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-12 col-lg-12 col-xl-12">
			<div class="modal-content mb-2">
				<div class="modal-header p-2">
					<h5 class="mb-0">DATA LEVEL DISKON</h5>
				</div>
				<div class="modal-body">
					<div class="row my-3">
						<div class="table-responsive">
							<table id="t_detail" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%; text-align: center;">
								<thead style="background-color: #68478D; color: #eee;">
									<tr>
										<th width="10">Action</th>
										<th width="100">Kode</th>
										<th width="100">No Referensi</th>
										<th width="30">Kode Barang</th>
										<th width="30">Nama Barang</th>
										<th width="30">Diskon</th>

										<th width="50">Kondisi 1</th>
										<th width="50">Kondisi 2</th>
										<th width="50">Aktif</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="changeharga">
	<div class="modal-dialog modal-md">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">UBAH DETAIL</h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row mb-2">
					<div class="col-sm-6 input-group">
						<div class="col-sm-6 p-0 input-group-prepend">
							<span class="col-sm-12 input-group-text">Kode</span>
						</div>
						<input class="form-control" type="text" name="chgkode" id="chgkode" maxlength="50" placeholder="Kode" readonly required />
					</div>
					<div class="col-sm-6 input-group box">
						<div class="col-sm-6 p-0 input-group-prepend">
							<span class="col-sm-12 input-group-text">Nama Cabang</span>
						</div>
						<input class="form-control" type="text" name="chgnama" id="chgnama" maxlength="50" placeholder="Nama Cabang" required readonly />
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-sm-6 input-group">
						<div class="col-sm-6 p-0 input-group-prepend">
							<span class="col-sm-6 input-group-text">Harga Beli</span>
						</div>
						<input class="form-control" type="text" name="chghargabeli" id="chghargabeli" maxlength="50" placeholder="Harga Beli" required />
					</div>
					<div class="col-sm-6 input-group">
						<div class="col-sm-6 p-0 input-group-prepend">
							<span class="col-sm-6 input-group-text">Harga Jual</span>
						</div>
						<input class="form-control" type="text" name="chghargajual" id="chghargajual" maxlength="50" placeholder="Harga Jual" required />
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-sm-6 input-group">
						<div class="col-sm-6 p-0 input-group-prepend">
							<span class="col-sm-6 input-group-text">Diskon</span>
						</div>
						<input class="form-control" type="text" name="chgdiskon" id="chgdiskon" maxlength="50" placeholder="Diskon" required />
					</div>
					<div class="col-sm-6 input-group">
						<div class="col-sm-6 p-0 input-group-prepend">
							<span class="col-sm-6 input-group-text">Lokasi</span>
						</div>
						<input class="form-control" type="text" name="chglokasi" id="chglokasi" maxlength="50" placeholder="Lokasi" readonly required />
						<div class="input-group-text btn-dark" id="changedetail" data-dismiss="modal">
							<span class="input-group-addon">
								<i class="fa fa-random" style="color: #fff;"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcabang">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data Cabang</h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_cabang" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th width="10">Action</th>
								<th width="150">Kode Cabang</th>
								<th width="150">Nama Cabang</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findgroup">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data Cabang</h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_group" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th width="10">Action</th>
								<th width="150">Kode Group</th>
								<th width="150">Nama Group</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findbarang">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data Barang</h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_barang" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th width="10">Action</th>
								<th width="150">Kode Barang</th>
								<th width="150">Nama Barang</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
