<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <form action="<?= base_url('/administrator/data-ledger-bulanan') ?>" method="GET" enctype="multipart/form-data">
            <div class="card-header row">
              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control" name="ta" id="ta">
                    <option value="">Select Tahun Akademik</option>
                    <?php foreach ($thn_akademik->getResultArray() as $kls) : ?>
                      <option value="<?= $kls['kd_ta'] ?>"><?= $kls['thn_akademik']; ?> <?= $kls['semester']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span id="ta-feedback" class="error invalid-feedback"></span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <select class="form-control" name="kelas" id="kelas" onchange="getRombelByKls()">
                    <option value="">Select Kelas</option>
                    <?php foreach ($kelas->getResultArray() as $kls) : ?>
                      <option value="<?= $kls['id_kelas'] ?>">KELAS <?= $kls['romawi']; ?></option>
                    <?php endforeach; ?>
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
                <button type="submit" class="btn btn-primary btn-md btn-block"><i class="fas fa-search mr-1"></i>Show Ledger</button>
              </div>
              <div class="col-md-2">
                <?php if (!empty($_GET['kelas'])) : ?>
                  <button id="excelexportnilai" class="btn btn-info btn-md btn-block" type="button"><i class="fas fa-download mr-1"></i> Download Ledger</button>
                <?php endif; ?>
              </div>
            </div>
          </form>
          <div class="card-body">
            <input type="hidden" id="url" value="/Ladger/deleteDataLadger">
            <input type="hidden" id="tb" value="tbDataLadger()">
            <div id="tbDataNilaiMapel_wrapper" class="dataTables_wrapper dt-bootstrap4 table-responsive">
              <div class="row">
                <div class="col-sm-12 col-md-6"></div>
                <div class="col-sm-12 col-md-6"></div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <table style="width: 150%;" id="tbDataLadger" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="tbDataLadger_info">
                    <thead class="bg-gray-dark">
                      <tr role="row">
                        <th width="2%" rowspan="2">No</th>
                        <!-- <th width="20%">Nama Mapel</th> -->
                        <th width="5%" rowspan="2">NISN</th>
                        <th rowspan="2" width="12%">Nama</th>
                        <th colspan="<?= $list_mapel->getNumRows() ?>" class="text-center" width="20%">Kurikulum</th>
                        <th rowspan="2" class="text-center" width="5%" style="background-color: #025955;">Total</th>
                        <th rowspan="2" class="text-center" width="5%" style="background-color: #00917C;">Average</th>
                        <th rowspan="2" class="text-center" width="5%" style="background-color: #00917C;">Rank</th>
                      </tr>
                      <tr role="row">
                        <?php foreach ($list_mapel->getResultArray() as $lm) : ?>
                          <th><?= ($lm['nm_mapel_ing'] == '') ? $lm['nm_mapel'] : $lm['nm_mapel_ing']; ?></th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $NilaiBulanan = new App\Models\NilaiBulananModel; ?>
                      <?php $score = 0;
                      $no = 1;
                      foreach ($list_pesdik->getResultArray() as $lp) : ?>
                        <?php $nilai = $NilaiBulanan->getNilaiByNisn($lp['nisn'], $lm['kd_mapel'], $_GET['ta'], $_GET['bulan']); ?>
                        <?php foreach ($nilai as $ni) : ?>
                          <?php $score += ($ni['score']); ?>
                        <?php endforeach; ?>
                        <?php $rank[] = $score;
                        rsort($rank);
                        $score = 0; ?>
                      <?php endforeach; ?>
                      <?php $tp = 0;
                      $tk = 0;
                      $no = 1;
                      foreach ($list_pesdik->getResultArray() as $lp) : ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td>'<?= $lp['nisn']; ?></td>
                          <td><?= $lp['nm_pesdik']; ?></td>
                          <?php $nilai = $NilaiBulanan->getNilaiByNisn($lp['nisn'], $lm['kd_mapel'], $_GET['ta'], $_GET['bulan']); ?>
                          <?php foreach ($nilai as $n) : ?>
                            <td style="text-align:center; background-color: #95E1D3; color:<?= ($n['score'] < $kkm->standard) ? '#B61919;' : '#000;'; ?>"><strong><?= ($n['score'] == '') ? '0' : $n['score']; ?></strong></td>
                            <?php $tp += $n['score']; ?>

                          <?php endforeach; ?>
                          <td style="text-align:right; background-color: #A4EBF3;"><strong><?= $amount = $tp;
                                                                                            $ap = $amount / ($list_mapel->getNumRows());
                                                                                            $ak = ($tk / $list_mapel->getNumRows());
                                                                                            $tk = 0;
                                                                                            $tp = 0; ?></strong></td>
                          <!-- <td style="text-align:right; background-color: #A4EBF3;"><strong><?= number_format($ap, 2); ?></strong></td> -->
                          <td style="text-align:right; background-color: #CCF2F4;"><strong><?= number_format($ap, 2); ?></strong></td>
                          <td class="text-center"><strong><?= $key = array_search($amount, $rank) + 1; ?></strong></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  <label>NB: P = NILAI PENGETAHUAN | K = NILAI KETERAMPILAN</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
<?= $this->endSection(); ?>