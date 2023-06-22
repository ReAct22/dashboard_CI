<div class="col-md-12 mb-2">
	<div class="modal-header" style="padding: 5px;">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3">
					<h2>
						<span class="logo-menu"><?php echo $icons ?></span>
						<span><?php echo $title ?></span>
					</h2>
				</div>
				<div class="col-md-9">
					<div class="form-group" style="float: right;">
						<button id="save" class="btn btn-sm btn-dark m-1" style="margin-bottom: 0px;"><i class="far fa-save" style="margin-right: 10px;"></i>Save</button>
						<button id="update" class="btn btn-sm btn-dark m-1" style="margin-bottom: 0px;"><i class="far fa-money-check-edit" style="margin-right: 10px;"></i>Update</button>
						<button data-toggle="modal" data-target="#finduser" id="find" class="btn btn-sm btn-dark m-1" style="margin-bottom: 0px;"><i class="far fa-file-search" style="margin-right: 10px;"></i>Find</button>
						<button id="clear" class="btn btn-sm btn-dark m-1" style="margin-bottom: 0px;"><i class="far fa-refresh" style="margin-right: 10px;"></i>Clear</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12 table-responsive hidescroll" style="height: 555px; overflow-y: scroll;">
	<div class="row">
		<div class="col-md-12">
			<div class="modal-content mb-2">
				<div class="modal-body">
					<div class="row mb-2 mt-2">
						<div class="col-sm-6 input-group">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Username</span>
							</div>
							<input class="form-control" type="text" name="login" id="login" maxlength="50" placeholder="Username" required autocomplete="off" />
						</div>
						<div class="col-sm-6 input-group">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Password</span>
							</div>
							<input class="form-control" type="password" name="password" id="password" maxlength="50" placeholder="Password" required autocomplete="off" />
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-12 input-group">
							<div class="col-sm-3 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Status HO</span>
							</div>
							<div class="input-group-text">
								<label class="radio radio-dark mb-0 mr-1 ml-1">
									<input type="radio" name="ho" id="ho" value="true"><span>YES</span><span class="checkmark"></span>
								</label>
								<label class="radio radio-dark mb-0 mr-1 ml-1">
									<input type="radio" name="ho" id="tidak_ho" value="false"><span>NO</span><span class="checkmark"></span>
								</label>
							</div>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-6 input-group">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Group</span>
							</div>
							<input class="form-control" type="text" name="group" id="group" maxlength="50" placeholder="Group" required readonly>
							<div class="input-group-text btn-dark" data-toggle="modal" data-target="#findgroup" id="carigroup">
								<span class="input-group-addon">
									<i class="fa fa-search text-white"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-6 input-group">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Kode Cabang</span>

							</div>
							<input class="form-control" type="text" name="kode_cabang" id="kode_cabang" maxlength="50" placeholder="Kode Cabang" readonly required />
							<div class="input-group-text btn-dark" data-toggle="modal" data-target="#findcabang" id="caricabang">
								<span class="input-group-addon">
									<i class="fa fa-search text-white"></i>
								</span>
							</div>
						</div>
						<div class="col-sm-6 input-group">
							<div class="col-sm-6 p-0 input-group-prepend">
								<span class="col-sm-6 input-group-text">Kode Gudang</span>

							</div>
							<input class="form-control" type="text" name="kode_gudang" id="kode_gudang" maxlength="50" placeholder="Kode Gudang" readonly required />
							<div class="input-group-text btn-dark" data-toggle="modal" data-target="#findgudang" id="carigudang">
								<span class="input-group-addon">
									<i class="fa fa-search text-white"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="row mb-2 aktif">
						<div class="col-sm-12 input-group">
							<div class="col-sm-3 p-0 input-group-prepend">
								<span class="col-sm-12 input-group-text">Status Aktif</span>
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
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="finduser">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data User</h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_user" class="table table-bordered table-striped" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th width="10">Action</th>
								<th width="150">Username</th>
								<th width="150">Group</th>
								<th width="150">Status</th>
								<th width="150">Cabang</th>
								<th width="150">Gudang</th>
								<th width="150">Aktif</th>
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

<!-- model Group -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findgroup">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data Group </h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_group" class="table table-bordered table-striped" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th width="10">Action</th>
								<th width="150">Group</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findcabang">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data Cabang </h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_cabang" class="table table-bordered table-striped" style="width:100%">
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findgudang">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius: 5px;">
			<div class="modal-header" style="padding: 10px; color: #000;">
				<h7 class="modal-title" style="margin-left: 5px;">Data Gudang</h7>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="t_gudang" class="table table-bordered table-striped" style="width:100%">
						<thead class="thead-dark">
							<tr>
								<th width="10">Action</th>
								<th width="150">Kode Gudang</th>
								<th width="150">Nama Gudang</th>
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
