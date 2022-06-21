<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <form id="form_1"  method="POST" enctype="multipart/form-data">
            <div class="card-header row">
              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control" name="ta" id="ta">
                    <option value="">Select Tahun Akademik</option>
                    <?php foreach($thn_akademik->getResultArray() as $kls): ?>
                      <option value="<?=$kls['kd_ta']?>"><?= $kls['thn_akademik']; ?> <?= $kls['semester']; ?></option>
                    <?php endforeach;?>
                  </select>
                  <span id="ta-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control" name="kelas" id="kelas" onchange="getMapelByKls(),getRombelByKls()">
                    <option value="">Select Kelas</option>
                    <?php foreach($kelas->getResultArray() as $kls): ?>
                      <option value="<?=$kls['id_kelas']?>">KELAS <?= $kls['romawi']; ?></option>
                    <?php endforeach;?>
                  </select>
                  <span id="kelas-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control" name="rombel" id="rombel" onchange="tbDataNilaiBulanan()">
                    <option value="">Select Rombel</option>
                  </select>
                  <span id="rombel-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control" name="mapel" id="mapel" onchange="$('#bulan').val('')">
                    <option value="">Select Mapel</option>
                  </select>
                  <span id="mapel-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="month" class="form-control" name="bulan" id="bulan" onchange="tbDataNilaiBulanan()">
                  <span id="bulan-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-md pull-right" onclick="formUploadNilai()"><i class="fas fa-upload mr-1"></i> Upload Nilai</button>
              </div>
            </div>           
            <!-- Form Upload -->
            <div class="card card-default" id="form-upload" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Upload Nilai Bulanan</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group">
                    <input type="hidden" value="/NilaiBulanan/uploadDataNilaiBulanan" name="action" id="action">
                    <input type="hidden" value="tbDataNilaiBulanan()" name="table" id="table">
                  </div>
                  <div class="col-md-12">
                    <div class="callout callout-info">
                      Untuk upload nilai bulanan, pertama download format nilai excel melalui link berikut <button id="excelnilaibulan" class="btn btn-info btn-sm" type="button">Download Format Nilai</button>, setelah itu isi file tersebut sesuai format, selanjutnya save dan upload file melalui form berikut.
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input form-control" id="import_nilai" name="import_nilai" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <span id="import_nilai-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">UPLOAD DATA</button>
              </div>
              </form>
            </div>
            
            <!-- Form Input  -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Edit Nilai</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <form id="form_2"  method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="hidden" value="" name="key" id="key">
                      <input type="hidden" value="/NilaiBulanan/updateDataNilaiBulanan" name="action" id="action">
                      <input type="hidden" value="tbDataNilaiBulanan()" name="table" id="table">
                      <label>Nama Pesdik</label>
                      <input class="form-control" name="nm_pesdik" id="nm_pesdik" placeholder="Nama Pesdik">
                      <span id="standard-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-2">
                      <label>Score</label>
                      <input class="form-control" name="score" id="score" placeholder="Score">
                      <span id="score-feedback" class="error invalid-feedback"></span>
                  </div>
                </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">SAVE DATA</button>
              </div>
              </div>
              </form>
            </div>

            <div class="card-body">
              <form id="deleteNilai">
              <input type="hidden" id="url" value="/NilaiBulanan/deleteDataNilaiBulanan">
              <input type="hidden" id="tb" value="tbDataNilaiBulanan()">
              <div id="tbDataNilaiBulanan_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataNilaiBulanan" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataNilaiBulanan_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10"><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='check-all' value='"+ value.id_nilai_mapel+"'><label for='check-all' class='custom-control-label'>No</label></div></th>
                      <th width="15%">NISN</th>
                      <th>Nama</th>
                      <th width="10%">Score</th>
                      <th width="5%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <button class="btn btn-md btn-danger ml-3 mt-3"><i class="fa fa-trash"></i> Delete Selected Data</button>
          </form>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection(); ?> 