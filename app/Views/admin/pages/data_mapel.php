<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Mapel</button>
            </div>                   
            <!-- Form Input -->
            <div class="card card-default" id="form-input" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">Form Input Data Mapel</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
              <form id="form_1">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="form-group col-6">
                          <input type="hidden" value="" name="key" id="key">
                          <input type="hidden" value="/Mapel/insertMapel" name="action" id="action">
                          <input type="hidden" value="tbDataMapel()" name="table" id="table">
                          <label>Nama Mapel IDN</label>
                          <input type="text" class="form-control" name="nm_mapel" placeholder="Nama Mapel">
                          <span id="nm_mapel-feedback" class="error invalid-feedback"></span>
                        </div>
                        <div class="form-group col-6">
                          <label>Nama Mapel ING</label>
                          <input type="text" class="form-control" name="nm_mapel_ing" placeholder="Nama Mapel ING">
                          <span id="nm_mapel_ing-feedback" class="error invalid-feedback"></span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-4">
                          <label>Kelas</label>                           
                          <select class="form-control" name="kls_mapel">
                            <option value="">Select Kelas</option>
                            <?php foreach($kelas->getResultArray() as $kls): ?>
                              <option value="<?=$kls['id_kelas']?>">KELAS <?= $kls['romawi']; ?></option>
                            <?php endforeach;?>
                          </select>
                          <span id="kls_mapel-feedback" class="error invalid-feedback"></span>
                        </div>
                        <div class="form-group col-4">
                            <label>Kelompok</label>
                            <input type="text" class="form-control" name="kelompok_mapel" placeholder="Kelompok">
                            <span id="kelompok_mapel-feedback" class="error invalid-feedback"></span>
                        </div>
                        <div class="form-group col-4">
                            <label>Urutan</label>
                            <input type="text" class="form-control" name="urutan_mapel" placeholder="Urutan">
                            <span id="urutan-feedback" class="error invalid-feedback"></span>
                        </div>
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
              <div id="tbDataMapel_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">
                <table width="100%" id="tbDataMapel" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataMapel_info">
                  <thead class="bg-gray-dark">
                    <tr role="row">
                      <th width="10">No</th>
                      <th>Nama Mapel IDN</th>
                      <th>Nama Mapel ING</th>
                      <th>Kelas</th>
                      <th>Kelompok</th>
                      <th>Urutan</th>
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