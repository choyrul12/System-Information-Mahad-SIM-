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
                  <select class="form-control" name="kelas" id="kelas" onchange="getRombelByKls()">
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
                  <select class="form-control" name="rombel" id="rombel" onchange="tbDataNilaiEskul()">
                    <option value="">Select Rombel</option>
                  </select>
                  <span id="rombel-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-md pull-right" onclick="formUploadAbsensi()"><i class="fas fa-upload mr-1"></i> Upload Nilai</button>
              </div>
            </div>           
            <!-- Form Upload -->
            <div class="card card-default" id="form-upload" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Upload Nilai Eskul</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              
              <div class="card-body">
                <div class="row">
                    <div class="form-group">
                      <input type="hidden" value="/NilaiEskul/uploadDataNilaiEskul" name="action" id="action">
                      <input type="hidden" value="tbDataNilaiEskul()" name="table" id="table">
                    </div>
                  <div class="col-md-12">
                    <div class="callout callout-info">
                      Untuk upload nilai eskul, pertama download format nilai excel melalui link berikut <button id="excelexporteskul" class="btn btn-info btn-sm" type="button">Download Format Nilai Eskul</button>, setelah itu isi file tersebut sesuai format, selanjutnya save dan upload file melalui form berikut.
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
                      <input type="hidden" value="/NilaiEskul/updateDataNilaiEskul" name="action" id="action">
                      <input type="hidden" value="tbDataNilaiEskul()" name="table" id="table">
                      <label>Nama Pesdik</label>
                      <input class="form-control" name="nm_pesdik" id="nm_pesdik" placeholder="Nama Pesdik">
                      <span id="standard-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-2">
                      <label>Eskul 1</label>
                      <select class="form-control" name="eskul1" id="eskul1">
                        <option value="">Pilih Eskul</option>
                        <?php foreach($eskul->getResultArray() as $es): ?>
                          <option value="<?=$es['nm_eskul']?>"><?=$es['nm_eskul']?></option>
                        <?php endforeach;?>
                      </select>
                      <input class="form-control" name="nilai1" id="nilai1" placeholder="Nilai">
                      <span id="eskul1-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="col-md-2">
                      <label>Eskul 2</label>
                      <select class="form-control" name="eskul2" id="eskul2">
                        <option value="">Pilih Eskul</option>
                        <?php foreach($eskul->getResultArray() as $es): ?>
                          <option value="<?=$es['nm_eskul']?>"><?=$es['nm_eskul']?></option>
                        <?php endforeach;?>
                      </select>
                      <input class="form-control" name="nilai2" id="nilai2" placeholder="Nilai">
                      <span id="pts-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="col-md-2">
                      <label>Eskul 3</label>
                      <select class="form-control" name="eskul3" id="eskul3">
                        <option value="">Pilih Eskul</option>
                        <?php foreach($eskul->getResultArray() as $es): ?>
                          <option value="<?=$es['nm_eskul']?>"><?=$es['nm_eskul']?></option>
                        <?php endforeach;?>
                      </select>
                      <input class="form-control" name="nilai3" id="nilai3" placeholder="Nilai">
                      <span id="pts-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="col-md-2">
                      <label>Eskul 4</label>
                      <select class="form-control" name="eskul4" id="eskul4">
                        <option value="">Pilih Eskul</option>
                        <?php foreach($eskul->getResultArray() as $es): ?>
                          <option value="<?=$es['nm_eskul']?>"><?=$es['nm_eskul']?></option>
                        <?php endforeach;?>
                      </select>
                      <input class="form-control" name="nilai4" id="nilai4" placeholder="Nilai">
                      <span id="pts-feedback" class="error invalid-feedback"></span>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="btn-submit">SAVE DATA</button>
              </div>
              </form>
            </div>

            <div class="card-body">
              <form id="nilaiEskul">
              <div id="tbDataNilaiEskul_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="150%" id="tbDataNilaiEskul" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataNilaiEskul_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10"><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='check-all' value='"+ value.id_nilai_Eskul+"'><label for='check-all' class='custom-control-label'>No</label></div></th>
                      <!-- <th width="20%">Nama Eskul</th> -->
                      <th width="9%">NISN</th>
                      <th>Nama</th>
                      <th class="text-center">Eskul 1</th>
                      <th class="text-center">Nilai 1</th>
                      <th class="text-center">Eskul 2</th>
                      <th class="text-center">Nilai 2</th>
                      <th class="text-center">Eskul 3</th>
                      <th class="text-center">Nilai 3</th>
                      <th class="text-center">Eskul 4</th>
                      <th class="text-center">Nilai 4</th>
                      <th width="4%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
                <table class="table">
                  <tr>
                    <th colspan="2">Daftar Eskul</th>
                  </tr>
                  <tr>
                  <?php foreach($eskul->getResultArray() AS $es): ?>
                    <td><?=$es['nm_eskul'];?></td>
                  <?php endforeach; ?>
                 </tr>
                </table>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-md btn-danger ml-3 mt-3" onclick="deleteNilaiEskul()"><i class="fa fa-trash"></i> Delete Selected Data</button>
          <button type="submit" class="btn btn-md btn-primary ml-3 mt-3"><i class="fa fa-save"></i> Save Data</button>
          </form>
        </div>
      </div>
    </div>
  </section>
<?= $this->endSection(); ?> 