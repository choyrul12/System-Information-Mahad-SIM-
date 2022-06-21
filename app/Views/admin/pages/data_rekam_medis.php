<?= $this->extend('admin/layout/template'); ?>

<?= $this->section('content'); ?>

<section class="content">

    <div class="container-fluid">

      <div class="row">

        <div class="col-12">

          <div class="card">

            <div class="card-header">

              <button type="button" class="btn btn-primary btn-sm" onclick="$('#form-input').show(500),$('#btn-submit').text('SUBMIT DATA')"><i class="fas fa-plus mr-1"></i> Tambah Rekam Medis</button>
              <button id="excelexportrekammedis" class="btn btn-info btn-sm " type="button"><i class="fas fa-download mr-1"></i> Download Rekam Medis</button>

              <div class="form-group col-2 float-right">

                <input type="month" class="form-control" id="bulan_rekam_medis" name="bulan_rekam_medis" value="<?=date('Y-m')?>">

              </div>

            </div>                   

            <!-- Form Input -->

            <div class="card card-default" id="form-input" style="display: none;">

                <div class="card-header">

                    <h3 class="card-title">Form Input Rekam Medis Pesdik</h3>

                    <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>

                    </div>

                </div>

              <form id="form_1">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group  select2-purple">

                                <input type="hidden" value="" name="key" id="key">

                                <input type="hidden" value="/RekamMedis/insertRekamMedis" name="action" id="action">

                                <input type="hidden" value="tbDataRekamMedis()" name="table" id="table">

                                <label for="exampleInputEmail1">Nama Pesdik</label>

                                <select class="select2 form-control" id="list_pesdik" name='id_pesdik' data-placeholder="Pilih Nama Pesdik" data-dropdown-css-class="select2-purple" style="width: 100%; height:50px;">

                                </select>

                                <span id="nm_pesdik-feedback" class="error invalid-feedback"></span>

                            </div>

                            <div class="row">

                                <div class="form-group col-6">

                                    <label for="exampleInputEmail1">Tanggal Periksa</label>

                                    <input type="date" class="form-control" name="tgl_periksa" placeholder="Tanggal Periksa">

                                    <span id="tgl_periksa-feedback" class="error invalid-feedback"></span>

                                </div>

                                <div class="form-group col-6">

                                    <label for="exampleInputEmail1">Nama Petugas</label>
                                    <select class="form-control" name="petugas">
                                    <option>Pilih Petugas</option>
                                    <?php foreach($petugas_uks AS $pu): ?>
                                    <option value="<?=$pu['nm_petugas']?>"><?=$pu['nm_petugas']?></option>
                                    <?php endforeach; ?>
                                    </select>
                                    <span id="petugas-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Anamnesa</label>

                                    <textarea type="text" class="form-control" name="anamnesa" placeholder="Anamnesa"></textarea>

                                    <span id="anamnesa-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>
                            
                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Penyakit Dahulu</label>

                                    <textarea class="form-control" name="penyakit_dahulu" placeholder="Penyakit Dahulu"></textarea>

                                    <span id="penyakit_dahulu-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>
                            
                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Riwayat Keluarga</label>

                                    <input type="text" class="form-control" name="riwayat_keluarga" placeholder="Riwayat Keluarga">

                                    <span id="riwayat_keluarga-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>
                            
                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Pemeriksaan Fisik</label>

                                    <textarea class="form-control" name="pemeriksaan_fisik" placeholder="Pemeriksaan Fisik"></textarea>

                                    <span id="pemeriksaan_fisik-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Alergi</label>

                                    <input type="text" class="form-control" name="alergi" placeholder="Alergi">

                                    <span id="alergi-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>
                            
                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Diagnosis</label>

                                    <textarea type="text" class="form-control" name="diagnosis" placeholder="Diagnosis"></textarea>

                                    <span id="diagnosis-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Penanganan</label>

                                    <textarea type="text" class="form-control" name="penanganan" placeholder="Penanganan"></textarea>

                                    <span id="penanganan-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Obat</label>

                                    <input type="text" class="form-control" name="obat" placeholder="Obat">

                                    <span id="obat-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Catatan</label>

                                    <textarea type="text" class="form-control" name="note" placeholder="Catatan"></textarea>

                                    <span id="catatan-feedback" class="error invalid-feedback"></span>

                                </div>

                            </div>
                            
                            <div class="row">

                                <div class="form-group col-12">

                                    <label for="exampleInputEmail1">Status</label>

                                    <select class="form-control" name="status" id="status">
                                        <option>Pilih Status</option>
                                        <option value="Sehat (Rawat Jalan)">Sehat (Rawat Jalan)</option>
                                        <option value="Perawatan Di UKS">Perawatan Di UKS</option>
                                        <option value="Perawatan Di Rumah/RS">Perawatan Di Rumah/RS</option>
                                    </select>

                                    <span id="catatan-feedback" class="error invalid-feedback"></span>

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

              <div id="tbDataRekamMedis_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12">

                <table width="100%" id="tbDataRekamMedis" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataRekamMedis_info">

                  <thead class="bg-gray-dark">

                    <tr role="row">

                      <th width="10">No</th>

                      <th>Tanggal</th>

                      <th>Nama Pesdik</th>
                      
                      <th>Kelas</th>

                      <th>Anamnesa</th>

                      <th>Diagnosis</th>
                      
                      <th>Penyakit Dahulu</th>
                      
                      <th>Penyakit Sekarang</th>
                      
                      <th>Riwayat Kel</th>
                      
                      <th>Alergi</th>

                      <th>Penanganan</th>

                      <th>Obat</th>

                      <th>Keterangan</th>
                      
                      <th>Status</th>

                      <th>Petugas</th>

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