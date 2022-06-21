<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $count_pesdik; ?></h3>
                <p>Jumlah Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="/administrator/data-pesdik" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $count_rekam_medis_m; ?></h3>
              <p>Siswa Sakit / Bulan <?= date('F') ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-heartbeat"></i>
            </div>
            <a href="/administrator/data-rekam-medis" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $count_rekam_medis_y; ?></h3>
              <p>Siswa Sakit / Tahun <?= date('Y') ?></p>
            </div>
            <div class="icon">
              <i class="fas fa-heartbeat"></i>
            </div>
            <a href="/administrator/data-rekam-medis" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $count_obat ?></h3>
              <p>Stok Obat</p>
            </div>
            <div class="icon">
              <i class="fas fa-capsules"></i>
            </div>
            <a href="/administrator/data-stok-obat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Grafik Rekam Medis Peserta Didik</h3>
              <a href="/administrator/data-rekam-medis">View Report</a>
            </div>
          </div>
          <div class="card-body">
            <div class="position-relative mb-4">
              <canvas id="visitors-chart" height="300"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    
<?= $this->endSection(); ?>