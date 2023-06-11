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
                        <!-- <button data-toggle="modal" data-target="#findkonfigurasi" id="find" class="btn btn-sm btn-dark mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-file-search" style="margin-right: 10px;"></i>Find</button> -->
                        <button id="clear" class="btn btn-sm btn-dark mb-1 mt-1 mr-1 ml-1" style="margin-bottom: 0px;"><i class="far fa-refresh" style="margin-right: 10px;"></i>Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12 table-responsive hidescroll" style="height: 555px; overflow-y: scroll;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 col-xl-612">
            <div class="modal-content mb-2">
                <div class="modal-body">
                    <div class="row mb-2 mt-2">
                        <div class="col-sm-12 input-group">
                            <div class="col-sm-3 p-0 input-group-prepend">
                                <span class="col-sm-12 input-group-text">Kode</span>
                            </div>
                            <input class="col-sm-3 form-control" type="text" name="kode" id="kode" maxlength="3" placeholder="Kode" required />

                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12 input-group box">
                            <div class="col-sm-3 p-0 input-group-prepend">
                                <span class="col-sm-12 input-group-text">Nama Perusahaan</span>
                            </div>
                            <input class="form-control" type="text" name="namaperusahaan" id="namaperusahaan" maxlength="50" placeholder="Nama Perusahaan" required />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12 input-group">
                            <div class="col-sm-3 p-0 input-group-prepend">
                                <span class="col-sm-12 input-group-text">Alamat</span>
                            </div>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6 input-group">
                            <div class="col-sm-6 p-0 input-group-prepend">
                                <span class="col-sm-6 input-group-text">PKP</span>
                            </div>
                            <div class="input-group-text">
                                <label class="radio radio-dark mb-0 mr-1 ml-1">
                                    <input type="radio" name="statuspkp" id="yes" value="1"><span>Ya</span><span class="checkmark"></span>
                                </label>
                                <label class="radio radio-dark mb-0 mr-1 ml-1">
                                    <input type="radio" name="statuspkp" id="no" value="0"><span>Tidak</span><span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-6 input-group box">
                            <div class="col-sm-6 p-0 input-group-prepend">
                                <span class="col-sm-12 input-group-text">NPWP</span>
                            </div>
                            <input class="form-control" type="text" name="npwp" id="npwp" maxlength="50" placeholder="NPWP" required />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12 input-group box">
                            <div class="col-sm-3 p-0 input-group-prepend">
                                <span class="col-sm-12 input-group-text">Nama NPWP</span>
                            </div>
                            <input class="form-control" type="text" name="namanpwp" id="namanpwp" maxlength="50" placeholder="Nama NPWP" required />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-12 input-group">
                            <div class="col-sm-3 p-0 input-group-prepend">
                                <span class="col-sm-12 input-group-text">Alamat NPWP</span>
                            </div>
                            <textarea name="alamatnpwp" id="alamatnpwp" rows="3" class="form-control" placeholder="Alamat NPWP"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2" style="margin-left: 23%;">
                        <div class="col-sm-12 input-group">
                            <div class="col-sm-3 p-0 input-group-prepand">
                                <span class="col-sm-12 input-group-text">
                                    <input type="checkbox" name="alamatcek" id="alamatcek" class="alamatcek" />&nbsp;
                                    alamat sama
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2 mt-2">
                        <div class="col-sm-6 input-group box">
                            <div class="col-sm-6 p-0 input-group-prepend">
                                <span class="col-sm-6 input-group-text">PPN</span>
                            </div>
                            <input class="form-control" type="text" name="ppn" id="ppn" maxlength="3" placeholder="PPN" required />
                        </div>
                        <div class="col-sm-6 input-group box">
                            <div class="col-sm-6 p-0 input-group-prepend">
                                <span class="col-sm-6 input-group-text">Disc. Cash</span>
                            </div>
                            <input class="form-control" type="text" name="disccash" id="disccash" max="9999" placeholder="Disc. Cash" required />
                        </div>
                    </div>
                    <div class="row mb-2 nourut">
                        <div class="col-sm-6 input-group box">
                            <div class="col-sm-6 p-0 input-group-prepend">
                                <span class="col-sm-6 input-group-text">Disc. COD</span>
                            </div>
                            <input class="form-control" type="text" name="disccod" id="disccod" max="9999" placeholder="Disc. COD" required />
                        </div>
                        <div class="col-sm-6 input-group">
                            <div class="col-sm-6 p-0 input-group-prepend">
                                <span class="col-sm-6 input-group-text">No. Urut</span>
                            </div>
                            <div class="input-group-text">
                                <label class="radio radio-dark mb-0 mr-1 ml-1">
                                    <input type="radio" name="nourut" id="yesurut" value="0"><span>Ya</span><span class="checkmark"></span>
                                </label>
                                <label class="radio radio-dark mb-0 mr-1 ml-1">
                                    <input type="radio" name="nourut" id="nourut" value="1"><span>Tidak</span><span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2 backdate">
                        <div class="col-sm-6 input-group">
                            <div class="col-sm-6 p-0 input-group-prepend">
                                <span class="col-sm-6 input-group-text">Back Date</span>
                            </div>
                            <div class="input-group-text">
                                <label class="radio radio-dark mb-0 mr-1 ml-1">
                                    <input type="radio" name="backdate" id="yesbd" value="true"><span>Ya</span><span class="checkmark"></span>
                                </label>
                                <label class="radio radio-dark mb-0 mr-1 ml-1">
                                    <input type="radio" name="backdate" id="nobd" value="false"><span>Tidak</span><span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="findkonfigurasi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header" style="padding: 10px; color: #000;">
                <h7 class="modal-title" style="margin-left: 5px;">Data Konfigurasi</h7>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="t_konfigurasi" class="table table-bordered table-striped nowrap" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th width="10">Action</th>
                                <th width="150">Kode</th>
                                <th width="150">Nama Perusahaan</th>
                                <th width="150">Alamat</th>
                                <th width="150">PKP</th>
                                <th width="150">NPWP</th>
                                <th width="150">Nama NPWP</th>
                                <th width="150">Alamat NPWP</th>
                                <th width="150">PPN</th>
                                <th width="150">Disc. Cash</th>
                                <th width="150">No. Urut</th>
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
