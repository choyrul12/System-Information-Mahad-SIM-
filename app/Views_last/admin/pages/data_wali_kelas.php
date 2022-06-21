<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header row">
              <div class="col-md-4">
                <div class="input-group input-group-sm">
                  <select class="form-control select2bs4" name="ta" id="ta">
                    <option value="">Pilih Tahun Akademik</option>
                    <?php foreach($ta->getResultArray() AS $t):?>
                      <option value="<?=$t['kd_ta']?>"><?= $t['thn_akademik']."-".$t['semester']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input-group-append">
                    <button type="button" class="btn btn-primary" onclick="tbDataWaliKelas()"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-primary btn-md" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Data Wali Kelas</button>
              </div>  
            </div>          
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Input Wali Kelas</h3>
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
                      <input type="hidden" value="/WaliKelas/insertDataWaliKelas" name="action" id="action">
                      <input type="hidden" value="tbDataWaliKelas()" name="table" id="table">
                      <label>Nama Wali Kelas</label>
                      <select class="form-control select2bs4" name="nip_guru" id="nip_guru">
                        <option value="">Pilih Wali Kelas</option>
                        <?php foreach($guru->getResultArray() AS $g):?>
                          <option value="<?=$g['accesskey']?>"><?= $g['username'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <span id="nip_guru-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Rombel</label>
                      <select class="form-control" name="id_rombel" id="id_rombel">
                        <option value="">Pilih Rombel</option>
                        <?php foreach($rombel->getResultArray() AS $r):?>
                          <option value="<?=$r['id_rombel']?>"><?= $r['nm_rombel'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <span id="id_rombel-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tahun Akademik</label>
                      <select class="form-control" name="kd_ta">
                        <option value="">Pilih Tahun Akademik</option>
                        <?php foreach($ta->getResultArray() AS $t):?>
                          <option value="<?=$t['kd_ta']?>"><?= $t['thn_akademik']."-".$t['semester']; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <span id="kd_ta-feedback" class="error invalid-feedback"></span>
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
              <div id="tbDataWaliKelas_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataWaliKelas" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataWaliKelas_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <th width="20%">NIP</th>
                      <th>Nama Wali Kelas</th>
                      <th width="10%" class="text-center">Rombel</th>
                      <th width="12%" class="text-center">Action</th>
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