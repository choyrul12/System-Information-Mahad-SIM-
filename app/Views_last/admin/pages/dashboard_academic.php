<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $ta_aktif->thn_akademik." ".$ta_aktif->semester?> </h3>
              <p>Tahun Akademik</p>
            </div>
            <div class="icon">
              <i class="fas fa-calendar-alt"></i>
            </div>
            <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $count_pesdik; ?></h3>
                <p>Jumlah Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <!-- <a href="/administrator/data-pesdik" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$count_guru;?></h3>
              <p>Jumlah Guru</p>
            </div>
            <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <!-- <a href="/administrator/data-guru" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>
        </div>
      </div>
      <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header border-0">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Grafik Statistik Nilai Rata-rata Peserta Didik</h3>
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