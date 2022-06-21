<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-upload').show(500)"><i class="fas fa-upload mr-1"></i> Upload Data Pesdik</button>
            <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Data Pesdik</button>
            <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-naik-kelas').show(500)"><i class="fas fa-plus mr-1"></i> Pindah / Naik Kelas</button>
          </div>
          <!-- Form Naik Kelas -->
          <div class="card card-default" id="form-naik-kelas" style="display: none;">
            <div class="card-header">
              <h3 class="card-title">Form Pindah / Naik Kelas</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <form id="form_1">
              <div class="card-body">
                <div class="row">
                  <div class="form-group select2-purple col-12">
                    <input type="hidden" value="/pesdik/pindahKlsPesdik" name="action" id="action">
                    <input type="hidden" value="tbDataPesdik()" name="table" id="table">
                    <label>Nama Siswa</label>
                    <select class="select2" multiple="multiple" id="list_pesdik" name='list_pesdik[]' data-placeholder="Pilih Nama Pesdik" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    </select>
                    <span id="list_pesdik-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="form-group col-4">
                    <select class="form-control" name="id_pindah_kelas" id="id_pindah_kelas" onchange="selectRombel('id_pindah_kelas','id_pindah_rombel')">
                      <option value="">Select Kelas</option>
                      <?php foreach ($kelas->getResultArray() as $kls) : ?>
                        <option value="<?= $kls['id_kelas'] ?>">KELAS <?= $kls['romawi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <span id="id_pindah_kelas-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="form-group col-4">
                    <select class="form-control" name="id_pindah_rombel" id="id_pindah_rombel">
                      <option value="">Select Rombel</option>
                    </select>
                    <span id="id_pindah_rombel-feedback" class="error invalid-feedback"></span>
                  </div>
                  <div class="form-group col-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- Form Upload -->
          <div class="card card-default" id="form-upload" style="display: none;">
            <div class="card-header">
              <h3 class="card-title">Form Upload Data Pesdik</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="callout callout-info">
                    Pertama download format excel melalui link berikut <a href="<?= base_url('format_pesdik.xlsx') ?>" download class="btn btn-xs btn-secondary">Download Format Excel</a>, setelah itu isi file tersebut sesuai format, selanjutnya save dan upload file melalui form berikut.
                  </div>
                </div>
                <div class="col-md-6">
                  <form method="POST" enctype="multipart/form-data" id="form_2">
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="hidden" value="/pesdik/uploadDataPesdik" name="action" id="action">
                        <input type="hidden" value="tbDataPesdik()" name="table" id="table">
                        <input type="file" class="custom-file-input form-control" id="import_pesdik" name="import_pesdik" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <span id="import_pesdik-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-4">
                        <select class="form-control" name="id_kelas" id="id_kelas" onchange="selectRombel('id_kelas','id_rombel')">
                          <option value="">Select Kelas</option>
                          <?php foreach ($kelas->getResultArray() as $kls) : ?>
                            <option value="<?= $kls['id_kelas'] ?>">KELAS <?= $kls['romawi']; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <span id="id_kelas-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <select class="form-control" name="id_rombel" id="id_rombel">
                          <option value="">Select Rombel</option>
                        </select>
                        <span id="id_rombel-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-upload mr-1"></i> Upload</button>
                      </div>
                    </div>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Form Input -->
          <div class="card card-default" id="form-input" style="display: none;">
            <div class="card-header">
              <h3 class="card-title">Form Input Pesdik</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <form id="form_3">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" value="" name="key" id="key">
                      <input type="hidden" value="/pesdik/insertDataPesdik" name="action" id="action">
                      <input type="hidden" value="tbDataPesdik()" name="table" id="table">
                      <label for="exampleInputEmail1">Nama Pesdik</label>
                      <input type="text" class="form-control" name="nm_pesdik" placeholder="Nama Peserta Didik">
                      <span id="nm_pesdik-feedback" class="error invalid-feedback"></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sekolah Asal</label>
                      <input type="text" class="form-control" name="sekolah_asal" placeholder="Sekolah Asal">
                    </div>
                    <div class="row">
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Agama</label>
                        <input type="text" class="form-control" name="agama" placeholder="Agama">
                        <span id="agama-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                        <select class="form-control" name="jk">
                          <option selected value="">Jenis Kelamin</option>
                          <option value="L">Laki-laki</option>
                          <option value="P">Perempuan</option>
                        </select>
                        <span id="jk-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Jumlah Saudara</label>
                        <input type="text" class="form-control" name="jml_saudara" placeholder="Jumlah Saudara">
                        <span id="list_pesdik-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Anak Ke</label>
                        <input type="text" class="form-control" name="anak_ke" placeholder="Anak Ke">
                        <span id="anak_ke-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">NIK</label>
                        <input type="text" class="form-control" name="nik" placeholder="No NIK Pesdik">
                        <span id="nik-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">NIPD</label>
                        <input type="text" class="form-control" name="nipd" placeholder="No NIPD Pesdik">
                        <span id="nipd-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">NISN</label>
                        <input type="text" class="form-control" name="nisn" placeholder="No NISN Pesdik">
                        <span id="nisn-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">No KK</label>
                        <input type="text" class="form-control" name="no_kk" placeholder="No KK">
                        <span id="list_pesdik-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">No Akte</label>
                        <input type="text" class="form-control" name="no_akte" placeholder="No Akte">
                        <span id="no_akte-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">No Ijazah</label>
                        <input type="text" class="form-control" name="no_ijazah" placeholder="No Ijazah">
                        <span id="no_ijazah-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">No SKHUN</label>
                        <input type="text" class="form-control" name="skhun" placeholder="No SKHUN">
                        <span id="skhun-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">Kelas</label>
                        <select class="form-control" name="kelas" id="kelas" onchange="selectRombel('kelas','rombel')">
                          <option value="">Select Kelas</option>
                          <?php foreach ($kelas->getResultArray() as $kls) : ?>
                            <option value="<?= $kls['id_kelas'] ?>">KELAS <?= $kls['romawi']; ?></option>
                          <?php endforeach; ?>
                        </select>
                        <span id="kelas-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">Rombel</label>
                        <select class="form-control" name="rombel" id="rombel">
                          <option value="">Select Rombel</option>
                        </select>
                        <span id="rombel-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" placeholder="jurasan">
                        <span id="jurusan-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tpt_lahir" placeholder="Tempat Lahir">
                        <span id="tpt_lahir-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Tangal Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir">
                        <span id="tgl_lahir-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" name="alamat" placeholder="Alamat">
                      <span id="alamat-feedback" class="error invalid-feedback"></span>
                    </div>
                    <div class="row">
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Rt</label>
                        <input type="text" class="form-control" name="rt" placeholder="RT">
                        <span id="rt-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Rw</label>
                        <input type="text" class="form-control" name="rw" placeholder="RW">
                        <span id="rw-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Dusun</label>
                        <input type="text" class="form-control" name="dusun" placeholder="Dusun / Desa">
                        <span id="dusun-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-5">
                        <label for="exampleInputEmail1">Kelurahan</label>
                        <input type="text" class="form-control" name="kelurahan" placeholder="Kelurahan">
                        <span id="kelurahan-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-5">
                        <label for="exampleInputEmail1">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan">
                        <span id="kecamatan-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-2">
                        <label for="exampleInputEmail1">Kode Pos</label>
                        <input type="text" class="form-control" name="kd_pos" placeholder="Kode Pos">
                        <span id="kd_pos-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <span id="email-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">No Telepon</label>
                        <input type="text" class="form-control" name="no_tlp" placeholder="No Telepon">
                        <span id="no_tlp-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">No Hp</label>
                        <input type="text" class="form-control" name="no_hp" placeholder="No Hp">
                        <span id="no_hp-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Ayah</label>
                      <input type="text" class="form-control" name="nm_ayah" placeholder="Nama Ayah">
                      <span id="nm_ayah-feedback" class="error invalid-feedback"></span>
                    </div>
                    <div class="row">
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Tahun Lahir Ayah</label>
                        <input type="text" class="form-control" name="thn_lahir_ayah" placeholder="Tahun Lahir Ayah">
                        <span id="thn_lahir_ayah-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-5">
                        <label for="exampleInputEmail1">Nik Ayah</label>
                        <input type="text" class="form-control" name="nik_ayah" placeholder="NIK Ayah">
                        <span id="nik_ayah-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">Pendidikan Ayah</label>
                        <input type="text" class="form-control" name="pendidikan_ayah" placeholder="Pendidikan Ayah">
                        <span id="pendidikan_ayah-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Pekerjaan</label>
                        <input type="text" class="form-control" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah">
                        <span id="pekerjaan_ayah-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Penghasilan Ayah</label>
                        <input type="text" class="form-control" name="penghasilan_ayah" placeholder="Penghasilan Ayah">
                        <span id="penghasilan_ayah-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Ibu</label>
                      <input type="text" class="form-control" name="nm_ibu" placeholder="Nama Ibu">
                      <span id="nm_ibu-feedback" class="error invalid-feedback"></span>
                    </div>
                    <div class="row">
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Tahun Lahir ibu</label>
                        <input type="text" class="form-control" name="thn_lahir_ibu" placeholder="Tahun Lahir Ibu">
                        <span id="thn_lahir_ibu-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-5">
                        <label for="exampleInputEmail1">Nik Ibu</label>
                        <input type="text" class="form-control" name="nik_ibu" placeholder="NIK Ibu">
                        <span id="nik_ibu-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">Pendidikan Ibu</label>
                        <input type="text" class="form-control" name="pendidikan_ibu" placeholder="Pendidikan Ibu">
                        <span id="pendidikan_ibu-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu">
                        <span id="pekerjaan_ibu-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Penghasilan Ibu</label>
                        <input type="text" class="form-control" name="penghasilan_ibu" placeholder="Penghasilan Ibu">
                        <span id="penghasilan_ibu-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama wali</label>
                      <input type="text" class="form-control" name="nm_wali" placeholder="Nama wali">
                      <span id="nm_wali-feedback" class="error invalid-feedback"></span>
                    </div>
                    <div class="row">
                      <div class="form-group col-3">
                        <label for="exampleInputEmail1">Tahun Lahir wali</label>
                        <input type="text" class="form-control" name="thn_lahir_wali" placeholder="Tahun Lahir Wali">
                        <span id="thn_lahir_wali-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-5">
                        <label for="exampleInputEmail1">Nik wali</label>
                        <input type="text" class="form-control" name="nik_wali" placeholder="NIK wali">
                        <span id="nik_wali-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-4">
                        <label for="exampleInputEmail1">Pendidikan wali</label>
                        <input type="text" class="form-control" name="pendidikan_wali" placeholder="Pendidikan wali">
                        <span id="pendidikan_wali-feedback" class="error invalid-feedback"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Pekerjaan</label>
                        <input type="text" class="form-control" name="pekerjaan_wali" placeholder="Pekerjaan wali">
                        <span id="pekerjaan_wali-feedback" class="error invalid-feedback"></span>
                      </div>
                      <div class="form-group col-6">
                        <label for="exampleInputEmail1">Penghasilan wali</label>
                        <input type="text" class="form-control" name="penghasilan_wali" placeholder="Penghasilan wali">
                        <span id="penghasilan_wali-feedback" class="error invalid-feedback"></span>
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
            <div id="tbDataPesdik_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive">
              <div class="row">
                <div class="col-sm-12 col-md-6"></div>
                <div class="col-sm-12 col-md-6"></div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <form id="lulusPesdik">
                    <input type="hidden" id="url" value="/Pesdik/updatePesdikLulus">
                    <input type="hidden" id="tb" value="tbDataPesdik()">
                    <div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='check-all'><label for='check-all' class='custom-control-label'>Select All</label></div>
                    <table width="100%" id="tbDataPesdik" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataPesdik_info">
                      <thead class="bg-gray-dark">
                        <tr role="row">
                          <th width="10">No</th>
                          <th width="10%">NISN</th>
                          <th width="10%">NIPD</th>
                          <th>Nama</th>
                          <th width="10%">Kelas</th>
                          <th width="10%">Rombel</th>
                          <?Php if (Session()->get('level') < 3) : ?>
                            <th width="9%">Action</th>
                          <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary btn-sm mt-2 mb-2"><i class="fas fa-check mr-1"></i>Update Pesdik Lulus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<?= $this->endSection(); ?>