<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Standard Sekolah</button>
            </div>           
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Input Standard Sekolah</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <form id="form_1"  method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="hidden" value="" name="key" id="key">
                      <input type="hidden" value="/Sekolah/insertDataSekolah" name="action" id="action">
                      <input type="hidden" value="tbDataSekolah()" name="table" id="table">
                      <label>Nama Sekolah</label>
                      <input class="form-control" type="text" placeholder="Nama Sekolah" name="nm_sekolah">
                      <span id="nm_sekolah-feedback" class="error invalid-feedback"></span>
                      <label>Nama Kepsek</label>
                      <input class="form-control" type="text" placeholder="Nama Kepsek" name="nm_kepsek">
                      <span id="nm_kepsek-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Alamat</label>
                      <textarea class="form-control" name="alamat" rows="4"></textarea>
                      <span id="alamat-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="btn-submit">SAVE DATA</button>
              </div>
              </form>
            </div>
            <!-- Form Input KKM -->
            <div class="card card-default" id="form-update-Sekolah" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Edit KKM</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <form id="form_2"  method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="hidden" value="" name="id_kkm" id="id_kkm">
                      <input type="hidden" value="/Sekolah/updateDataKkm" name="action" id="action">
                      <input type="hidden" value="tbDataSekolah()" name="table" id="table">
                      <label>Standar KKM</label>
                      <input class="form-control" name="standard" id="standard" placeholder="Standar KKM">
                      <span id="standard-feedback" class="error invalid-feedback"></span>
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
              <div id="tbDataSekolah_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataSekolah" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataSekolah_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <th width="20%">Nama Sekolah</th>
                      <th width="20%">Nama Kepsek</th>
                      <th>Alamat Sekolah</th>
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