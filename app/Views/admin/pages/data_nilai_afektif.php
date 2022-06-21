<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
          <form id="form_1"  method="POST" enctype="multipart/form-data">
            <div class="card-header row">
              <div class="col-md-3">
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
              <div class="col-md-3">
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
              <div class="col-md-3">
                <div class="form-group">
                  <select class="form-control" name="rombel" id="rombel" onchange="tbDataNilaiAfektif()">
                    <option value="">Select Rombel</option>
                  </select>
                  <span id="rombel-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
            </div>           
            <!-- Form Upload -->
            <div class="card card-default" id="form-upload" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Upload Nilai Afektif</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              
              <div class="card-body">
                <div class="row">
                    <div class="form-group">
                      <input type="hidden" value="/NilaiAfektif/uploadDataNilaiAfektif" name="action" id="action">
                      <input type="hidden" value="tbDataNilaiAfektif()" name="table" id="table">
                    </div>
                  <div class="col-md-12">
                    <div class="callout callout-info">
                      Untuk upload nilai semester, pertama download format nilai excel melalui link berikut <button id="excelexport" class="btn btn-info btn-sm" type="button">Download Format Nilai</button>, setelah itu isi file tersebut sesuai format, selanjutnya save dan upload file melalui form berikut.
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
                <button type="submit" class="btn btn-primary">SAVE DATA</button>
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
                      <input type="hidden" value="/NilaiAfektif/updateDataNilaiAfektif" name="action" id="action">
                      <input type="hidden" value="tbDataNilaiAfektif()" name="table" id="table">
                      <label>Nama Pesdik</label>
                      <input class="form-control" name="nm_pesdik" id="nm_pesdik" placeholder="Nama Pesdik">
                      <span id="standard-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-2">
                      <label>PH</label>
                      <input class="form-control" name="ph" id="ph" placeholder="PH">
                      <span id="ph-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="col-md-2">
                      <label>PTS</label>
                      <input class="form-control" name="pts" id="pts" placeholder="PTS">
                      <span id="pts-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="col-md-2">
                      <label>PAT</label>
                      <input class="form-control" name="pat" id="pat" placeholder="PAT">
                      <span id="pat-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="col-md-2">
                      <label>Keterampilan</label>
                      <input class="form-control" name="keterampilan" id="keterampilan" placeholder="Keterampilan">
                      <span id="keterampilan-feedback" class="error invalid-feedback"></span>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="btn-submit">SAVE DATA</button>
              </div>
              </form>
            </div>

            <div class="card-body">
              <form id="nilaiAfektif">
              <div id="tbDataNilaiAfektif_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataNilaiAfektif" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataNilaiAfektif_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10" rowspan="2"><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='check-all' value='"+ value.id_nilai_Afektif+"'><label for='check-all' class='custom-control-label'>No</label></div></th>
                      <th width="15%" rowspan="2">NISN</th>
                      <th rowspan="2">Nama</th>
                      <th width="20%" rowspan="2" class="text-center">Sikap Spiritual</th>
                      <th width="20%" rowspan="2" class="text-center">Sikap Sosial</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-md btn-danger ml-3 mt-3" onclick="deleteNilaiAfektif()"><i class="fa fa-trash"></i> Delete Selected Data</button>
          <button class="btn btn-md btn-primary ml-3 mt-3"><i class="fa fa-save"></i> Save Data</button>
          </form>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection(); ?> 