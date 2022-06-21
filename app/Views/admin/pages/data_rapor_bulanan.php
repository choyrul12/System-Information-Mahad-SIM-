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
                  <select class="form-control" name="rombel" id="rombel">
                    <option value="">Select Rombel</option>
                  </select>
                  <span id="rombel-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <input type="month" class="form-control" name="bulan" id="bulan">
                  <span id="bulan-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-block btn-md pull-right" onclick="tbDataRaporBulanan(),checkStatusRaporBulanan()"><i class="fas fa-check mr-1"></i> Submit</button>
              </div>
              <div class="col-md-2">
                  <button type="button" class="btn btn-block" id="btnStatus" style="display: none;" onclick="formReleaseRaporBulanan()"></button>
              </div>
            </div>           
    
            <!-- Form Input  -->
            <div class="card card-default" id="form-input" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Form Penerbitan Rapor</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="hidden" value="" name="key" id="key">
                      <input type="hidden" value="/RaporBulanan/terbitkanRaporBulanan" name="action" id="action">
                      <input type="hidden" value="tbDataRaporBulanan()" name="table" id="table">
                      <label>Nama Wali Kelas</label>
                      <select class="form-control select2bs4" name="nip_guru" id="nip_guru">
                        <option value="">Pilih Wali Kelas</option>
                        <?php foreach($guru->getResultArray() AS $g):?>
                          <option value="<?=$g['accesskey']?>"><?= $g['username'] ?></option>
                        <?php endforeach; ?>
                      </select>
                      <span id="wali_kelas-feedback" class="error invalid-feedback"></span>
                    </div>
                  </div>
                  <div class="col-md-4">
                      <label>Kota Penerbitan</label>
                      <input type="text" class="form-control" name="kota_terbit" id="kota_terbit" placeholder="Kota Terbit">
                      <span id="kota_terbit-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="col-md-4">
                      <label>Tanggal Penerbitan</label>
                      <input type="date" class="form-control" name="tgl_terbit" id="tgl_terbit" placeholder="Tanggal Terbit">
                      <span id="tgl_terbit-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="col-md-4">
                      <label>Jenis Rapor</label>
                      <select class="form-control" name="jenis" id="jenis">
                      	<option value="">Pilih Jenis Rapor</option>
                      	<option value="Rapor Bulanan">Raporan Bulanan</option>
                      	<option value="Rapor PTS">Rapor PTS</option>
                      </select>
                      <span id="jenis-feedback" class="error invalid-feedback"></span>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="btn-submit">SAVE DATA</button>
              </div>
              </form>
            </div>

            <div class="card-body">
              <input type="hidden" id="url" value="/RaporBulanan/deleteDataRaporBulanan">
              <input type="hidden" id="tb" value="tbDataRaporBulanan()">
              <div id="tbDataRaporBulanan_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataRaporBulanan" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataRaporBulanan_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10"><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='check-all' value='"+ value.id_Rapor_mapel+"'><label for='check-all' class='custom-control-label'>No</label></div></th>
                      <th width="15%">NISN</th>
                      <th>Nama</th>
                      <th width="15%">Action</th>
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