<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Standar Eskul</button>
            </div>           
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Input Eskul</h3>
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
                      <input type="hidden" value="/StdEskul/insertDataStdEskul" name="action" id="action">
                      <input type="hidden" value="tbDataStdEskul()" name="table" id="table">
                      <label>Predikat / Grade</label>
                      <select class="form-control" name="grade">
                        <option value="">Select Grade</option>
                        <option value="AMAT BAIK">AMAT BAIK</option>
                        <option value="BAIK">BAIK</option>
                        <option value="CUKUP">CUKUP</option>
                      </select>
                      <span id="grade-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Nilai Min</label>
                      <input class="form-control" name="min" placeholder="Nilai Min">
                      <span id="min-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Nilai Max</label>
                      <input class="form-control" name="max" placeholder="Nilai Max">
                      <span id="max-feedback" class="error invalid-feedback"></span>
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
            <div class="card card-default" id="form-update-Eskul" style="display: none;">
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
                      <input type="hidden" value="/Eskul/updateDataKkm" name="action" id="action">
                      <input type="hidden" value="tbDataEskul()" name="table" id="table">
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
              <div id="tbDataStdEskul_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataStdEskul" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataStdEskul_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <th>Predikat / Grade</th>
                      <th>Min</th>
                      <th>Max</th>
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