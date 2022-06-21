<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Obat</button>
            </div>                   
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">Form Input Data Stok Obat</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
              <form id="form_1">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" value="" name="key" id="key">
                                <input type="hidden" value="/StokObat/insertStokObat" name="action" id="action">
                                <input type="hidden" value="tbDataStokObat()" name="table" id="table">
                                <label>Nama Obat</label>
                                <input type="text" class="form-control" name="nm_obat" placeholder="Nama Obat">
                                <span id="nm_obat-feedback" class="error invalid-feedback"></span>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Jenis Obat</label>
                                    <input type="text" class="form-control" name="jenis" placeholder="Jenis Obat">
                                    <span id="jenis-feedback" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group col-2">
                                    <label>Stok Obat</label>
                                    <input type="number" class="form-control" name="stok" placeholder="Stok">
                                    <span id="stok-feedback" class="error invalid-feedback"></span>
                                </div>
                                <div class="form-group col-4">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" name="satuan" placeholder="Satuan">
                                    <span id="satuan-feedback" class="error invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id="btn-submit">SAVE DATA</button>
                </div>
              </form>
            </div>
            <div class="card-body">
              <div id="tbDataStokObat_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataStokObat" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataStokObat_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <th>Nama Obat</th>
                      <th>Jenis Obat</th>
                      <th>Stok</th>
                      <th>Satuan</th>
                      <th>Last Update</th>
                      <th width="8%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection(); ?>