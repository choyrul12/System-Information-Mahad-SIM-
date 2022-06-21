<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-upload').show(500)"><i class="fas fa-upload mr-1"></i> Upload Data Guru</button>
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Data Guru</button>
            </div>            
            <!-- Form Upload -->
            <div class="card card-default" id="form-upload" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Upload Data Guru</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="callout callout-info">
                      Pertama download format excel melalui link berikut <a href="<?=base_url('format_Guru.xlsx')?>" download class="btn btn-xs btn-secondary">Download Format Excel</a>, setelah itu isi file tersebut sesuai format, selanjutnya save dan upload file melalui form berikut.
                    </div>
                  </div>
                  <div class="col-md-6">
                  <form method="POST" enctype="multipart/form-data" id="form_2">
                    <div class="form-group col-12">
                      <div class="custom-file">
                        <input type="hidden" value="/Guru/uploadDataGuru" name="action" id="action">
                        <input type="hidden" value="tbDataGuru()" name="table" id="table">
                        <input type="file" class="custom-file-input form-control" id="import_guru" name="import_guru" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <span id="import_Guru-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="form-group col-3">
                      <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-upload mr-1"></i> Upload</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Input Guru</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <form id="form_1"  method="POST">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="hidden" value="" name="key" id="key">
                      <input type="hidden" value="/Guru/insertDataGuru" name="action" id="action">
                      <input type="hidden" value="tbDataGuru()" name="table" id="table">
                      <label for="exampleInputEmail1">NIP</label>
                      <input type="text" class="form-control" name="accesskey" placeholder="NIP">
                      <span id="accesskey-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Guru</label>
                      <input type="text" class="form-control" name="username" placeholder="Nama Guru">
                      <span id="username-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Password">
                      <span id="password-feedback" class="error invalid-feedback"></span>
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
              <div id="tbDataGuru_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataGuru" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataGuru_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <th width="20%">NIP</th>
                      <th>Nama Guru</th>
                      <th width="10%">Status</th>
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