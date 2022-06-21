<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Tahun Akademik</button>
            </div>           
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Input Tahun Akademik</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <form id="form_1"  method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" value="" name="key" id="key">
                      <input type="hidden" value="/ThnAkademik/insertDataThnAkademik" name="action" id="action">
                      <input type="hidden" value="tbDataThnAkademik()" name="table" id="table">
                      <label for="exampleInputEmail1">Tahun Akademik</label>
                      <input type="text" class="form-control" name="thn_akademik" placeholder="Tahun Akademik (contoh 2020/2021)">
                      <span id="thn_akademik-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Semester</label>
                      <select class="form-control" name="semester">
                        <option value="">Pilih Semester</option>
                        <option value="1">GANJIL</option>
                        <option value="2">GENAP</option>
                      </select>
                      <span id="semester-feedback" class="error invalid-feedback"></span>
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
              <div id="tbDataThnAkademik_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataThnAkademik" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataThnAkademik_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <th width="20%">Kode</th>
                      <th>Tahun Akademik</th>
                      <th width="10%">Semester</th>
                      <th width="12%">Status</th>
                      <th width="12%">Action</th>
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