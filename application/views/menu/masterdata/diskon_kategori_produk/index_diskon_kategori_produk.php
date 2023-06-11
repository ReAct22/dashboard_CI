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
						<button data-toggle="modal" data-target="#finddisckkhususpelanggan" id="find" class="btn btn-sm btn-dark mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-file-search" style="margin-right: 10px;"></i>Find</button>
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
					<div class="row mb-2">
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Kode Kategori</span>
							</div>
							<input class="form-control" type="text" name="nomorpelanggan" id="kodekategori" maxlength="50" placeholder="Kode Kategori" required readonly />
							<div class="input-group-text btn-dark" data-toggle="modal" data-target="#findkategori" id="carikategori">
								<span class="input-group-addon">
									<i class="fa fa-search text-white"></i>
								</span>
							</div>
						</div>
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Diskon</span>
							</div>
							<input class="form-control" type="text" name="diskon" id="diskon" maxlength="50" placeholder="Diskon" required />
						</div>
					</div>
					<div class="row mb-2 mb-2 aktif">
						<div class="col-sm-6 input-group">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Status Aktif</span>
							</div>
							<div class="input-group-text">
								<label class="radio radio-dark mb-0 mr-1 ml-1">
									<input type="radio" name="aktif" id="aktif" value="true"><span>YES</span><span class="checkmark"></span>
								</label>
								<label class="radio radio-dark mb-0 mr-1 ml-1">
									<input type="radio" name="aktif" id="tidak_aktif" value="false"><span>NO</span><span class="checkmark"></span>
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
					<h5 class="mb-0">DATA DETAIL DOKUMEN</h5>
				</div>
				<div class="modal-body">
					<div class="row mb-2">
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Kode Merk</span>
							</div>
							<input class="form-control" type="text" name="kodemerk" id="kodemerk" maxlength="50" placeholder="Kode Merk" required readonly />
							<div class="input-group-text btn-dark" data-toggle="modal" data-target="#findmerk" id="carimerk">
								<span class="input-group-addon">
									<i class="fa fa-search text-white"></i>
								</span>
							</div>
						</div>
						<div class="col-sm-6 input-group box">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Nama Merk</span>
							</div>
							<input class="form-control" type="text" name="namamerk" id="namamerk" maxlength="50" placeholder="Nama Barang" required readonly />
							<div class="input-group-text btn-dark" id="adddetail">
								<span class="input-group-addon">
									<i class="far fa-plus text-white"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="row my-3">
						<div class="table-responsive">
							<table id="t_detail" class="table table-bordered table-striped table-default mb-0 t-scroll" style="width:100%;">
								<thead style="background-color: #408080; color: #eee;">
									<tr style="line-height: 0.5 cm; ">
										<th style="text-align: center; ">
											Kode
										</th>
										<th style="text-align: center; ">
											Nama
										</th>
										<th style="text-align: center; ">
											Action
										</th>
									</tr>
								</thead>
								<tbody class="tbody-scroll scroller" id="tb_detail"></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findkategori">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data Kategori</h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_kategori" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th width="10">Action</th>
								<th width="150">Nomor</th>
								<th width="150">Nama Kategori</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findmerk">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data Merk</h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_merk" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th width="10">Action</th>
								<th width="150">Kode Merk</th>
								<th width="150">Nama Merk</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="finddisckkhususpelanggan">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data Diskon</h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_find" class="table table-bordered table-striped dt-responsive display nowrap" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th width="10">Action</th>
								<!-- <th width="150">Kode</th> -->
								<th width="150">Nomor Pelanggan</th>
								<!-- <th width="150">Kode Merk</th> -->
								<th width="150">Diskon</th>
								<th width="150">Status</th>
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
