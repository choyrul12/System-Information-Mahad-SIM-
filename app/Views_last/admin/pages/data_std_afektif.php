<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Standard Afektif</button>
            </div>           
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Input Standard Afektif</h3>
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
                      <input type="hidden" value="/Afektif/insertDataAfektif" name="action" id="action">
                      <input type="hidden" value="tbDataAfektif()" name="table" id="table">
                      <label>Kelas</label>
                      <select class="form-control" name="kelas">
                        <option value="">Select Kelas</option>
                        <?php foreach($kelas->getResultArray() as $kls): ?>
                          <option value="<?=$kls['id_kelas']?>">KELAS <?= $kls['romawi']; ?></option>
                        <?php endforeach;?>
                      </select>
                      <span id="kelas-feedback" class="error invalid-feedback"></span>
                      <label>Kategori</label>
                      <select class="form-control" name="kategori">
                        <option value="">Select Kotegori Sikap</option>
                        <option value="SOSIAL">SOSIAL</option>
                        <option value="SPIRITUAL">SPIRITUAL</option>
                      </select>
                      <span id="kategori-feedback" class="error invalid-feedback"></span>
                      <label>Grade</label>
                      <select class="form-control" name="predikat">
                        <option value="">Select Afektif</option>
                        <option value="SANGAT BAIK">SANGAT BAIK</option>
                        <option value="BAIK">BAIK</option>
                        <option value="CUKUP">CUKUP</option>
                        <option value="KURANG">KURANG</option>
                      </select>
                      <span id="grade-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Deskripsi</label>
                      <textarea class="form-control" name="deskripsi" rows="7"></textarea>
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
            <div class="card card-default" id="form-update-Afektif" style="display: none;">
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
                      <input type="hidden" value="/Afektif/updateDataKkm" name="action" id="action">
                      <input type="hidden" value="tbDataAfektif()" name="table" id="table">
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
              <div id="tbDataAfektif_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataAfektif" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataAfektif_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <th width="10%">Kategori</th>
                      <th width="10%">Grade</th>
                      <th>Deskripsi</th>
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