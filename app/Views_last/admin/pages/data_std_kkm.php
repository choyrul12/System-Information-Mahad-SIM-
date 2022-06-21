<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Grade</button>
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-update-grade').show(500),$('#btn-submit').text('SUBMIT DATA'),editKkm('<?= $kkm->id_kkm; ?>')">Standard KKM : <b><?= $kkm->standard; ?></b></button>
            </div>           
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Input Grade</h3>
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
                      <input type="hidden" value="/Grade/insertDataGrade" name="action" id="action">
                      <input type="hidden" value="tbDataGrade()" name="table" id="table">
                      <label>Grade</label>
                      <select class="form-control" name="grade">
                        <option value="">Select Grade</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
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
            <div class="card card-default" id="form-update-grade" style="display: none;">
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
                      <input type="hidden" value="/Grade/updateDataKkm" name="action" id="action">
                      <input type="hidden" value="tbDataGrade()" name="table" id="table">
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
              <div id="tbDataGrade_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataGrade" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataGrade_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <th>Grade</th>
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