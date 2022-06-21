<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <form id="form_1" method="POST">
            <div class="card-header">
              <button type="button" class="btn btn-primary btn-sm pull-right" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Standard Keterampilan</button>
              <div class="card-tools">
                <table>
                  <tr>
                    <td>
                      <select class="form-control" name="ta" id="ta">
                        <option value="">Select Tahun Akademik</option>
                        <?php foreach ($thn_akademik->getResultArray() as $kls) : ?>
                          <option value="<?= $kls['kd_ta'] ?>"><?= $kls['thn_akademik']; ?> <?= $kls['semester']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>
                      <select class="form-control" name="kelas" id="kelas" onchange="getMapelByKls()">
                        <option value="">Select Kelas</option>
                        <?php foreach ($kelas->getResultArray() as $kls) : ?>
                          <option value="<?= $kls['id_kelas'] ?>">KELAS <?= $kls['romawi']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td></td>
                    <td>
                      <select class="form-control" name="mapel" id="mapel" onchange="tbDataStdKeterampilan()">
                        <option value="">Select Mapel</option>
                      </select>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Input Standard Keterampilan</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="form-group">
                    <input type="hidden" value="" name="key" id="key">
                    <input type="hidden" value="/StdKeterampilan/insertDataStdKeterampilan" name="action" id="action">
                    <input type="hidden" value="tbDataStdKeterampilan()" name="table" id="table">
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Deskripsi Grade A</label>
                      <textarea class="form-control" name="grade_a" rows="4"></textarea>
                      <span id="grade_a-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Deskripsi Grade B</label>
                      <textarea class="form-control" name="grade_b" rows="4"></textarea>
                      <span id="grade_b-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Deskripsi Grade C</label>
                      <textarea class="form-control" name="grade_c" rows="4"></textarea>
                      <span id="grade_c-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Deskripsi Grade D</label>
                      <textarea class="form-control" name="grade_d" rows="4"></textarea>
                      <span id="grade_d-feedback" class="error invalid-feedback"></span>
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
        <div class="card card-default" id="form-update-Keterampilan" style="display: none;">
          <div class="card-header">
            <h3 class="card-title">Form Edit KKM</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <form id="form_2" method="POST">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="hidden" value="" name="id_kkm" id="id_kkm">
                    <input type="hidden" value="/Keterampilan/updateDataKkm" name="action" id="action">
                    <input type="hidden" value="tbDataStdKeterampilan()" name="table" id="table">
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
          <div id="tbDataStdKeterampilan_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive">
            <div class="row">
              <div class="col-sm-12 col-md-6"></div>
              <div class="col-sm-12 col-md-6"></div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <table width="100%" id="tbDataStdKeterampilan" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataStdKeterampilan_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <!-- <th width="20%">Nama Mapel</th> -->
                      <th width="5%">Grade</th>
                      <th>Deskripsi</th>
                      <th width="10%">Action</th>
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