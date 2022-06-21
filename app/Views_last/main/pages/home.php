<?= $this->extend('main/layout/template'); ?>
<?= $this->section('content'); ?>
<header class="header-2">
    <div class="page-header section-height-90 relative" style="background-image: url('<?= base_url() ?>/assets/img/header.jpg')">
      <div class="position-absolute w-100 z-index-1 bottom-0">
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
          <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
          </defs>
          <g class="moving-waves">
            <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
            <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
            <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
            <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
          </g>
        </svg>
      </div>
    </div>
  </header>
  <section  id="download-soft-ui">
    <div class="container py-7 postion-relative z-index-2 position-relative">
      <div class="row">
        <div class="col-lg-2 col-sm-3 ms-auto me-auto" data-bs-toggle="modal" data-bs-target="#modal-monthly-raport" title="Rapor Bulanan Santri">
          <div class="card card-background card-background-mask-primary tilt cursor-pointer" data-tilt>
            <div class="full-background" style="background-image: url('<?=base_url('assets/img/patern.jpg')?>')"></div>
            <div class="card-body text-center">
              <div class="icon icon-lg mt-2">
                <img src="<?= base_url() ?>/assets/img/logos/raport-icn.png" alt="">
              </div>
              <p class="text-white h6">Monthly Report</p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-sm-3 ms-auto me-auto" data-bs-toggle="modal" data-bs-target="#modal-semester-raport" title="Rapor Semester Santri">
          <div class="card card-background card-background-mask-primary tilt cursor-pointer" data-tilt>
            <div class="full-background" style="background-image: url('<?=base_url('assets/img/patern.jpg')?>')"></div>
            <div class="card-body text-center">
              <div class="icon icon-lg mt-2">
                <img src="<?= base_url() ?>/assets/img/logos/raport-icn.png" alt="">
              </div>
              <p class="text-white h6">Semester Report</p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-sm-3 ms-auto me-auto" onclick="window.location.href = '<?= base_url('health-report'); ?>'" title="Rekam Medis Santri">
          <div class="card card-background card-background-mask-primary tilt cursor-pointer" data-tilt>
            <div class="full-background" style="background-image: url('<?=base_url('assets/img/patern.jpg')?>')"></div>
            <div class="card-body text-center">
              <div class="icon icon-lg mt-2">
                <img src="<?= base_url() ?>/assets/img/logos/uks-icn.png" alt="">
              </div>
              <h6 class="text-white">Health Report</h6>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-sm-3 ms-auto me-auto">
          <div class="card card-background card-background-mask-primary tilt cursor-pointer" data-tilt>
            <div class="full-background" style="background-image: url('<?=base_url('assets/img/patern.jpg')?>')"></div>
            <div class="card-body text-center">
              <div class="icon icon-lg mt-2">
                <img src="<?= base_url() ?>/assets/img/logos/news-icn.png" alt="">
              </div>
              <h6 class="text-white">News</h6>
            </div>
          </div>
        </div>
        <!-- <div class="col-lg-2 col-sm-3 ms-auto me-auto">
          <div class="card card-background card-background-mask-primary tilt cursor-pointer" data-tilt>
            <div class="full-background" style="background-image: url('<?=base_url('assets/img/patern.jpg')?>')"></div>
            <div class="card-body text-center">
              <div class="icon icon-lg mt-2">
                <img src="<?= base_url() ?>/assets/img/logos/activity-icn.png" alt="">
              </div>
              <h6 class="text-white">Activity</h6>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </section>

  <div class="modal fade" id="modal-monthly-raport" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card card-plain">
            <div class="card-header pb-0 text-left">
              <h5 class="font-weight-bolder text-info text-center text-gradient">MONTHLY REPORT CARD</h5>
              <hr>
            </div>
            <div class="card-body">
              <form role="form text-left" id="searchMonthlyReport">
                <div class="input-group mb-3">
                  <select class="form-control" name="ta" required>
                    <option value="">Select Academic Year</option>
                    <?php foreach($ta->getResultArray() AS $t): ?>
                    <option value="<?=$t['kd_ta']?>"><?=$t['thn_akademik']." ".$t['semester'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <select class="form-control" name="kls" id="kls" required onchange="selectRombel('kls','rombel')">
                    <option value="">Select Class</option>
                    <?php foreach($kls->getResultArray() AS $kl): ?>
                    <option value="<?=$kl['id_kelas']?>"><?=$kl['romawi'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <select class="form-control" name="rombel" id="rombel" required>
                    <option value="">Select Rombel Class</option>
                    <option value=""></option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <input type="month" class="form-control" name="month" required>
                </div>
                <input type="hidden" name="id" value="<?=session()->get('id');?>">
                <div class="text-center">
                  <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0"><i class="fa fa-search">&nbsp;</i> Search</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-semester-raport" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card card-plain">
            <div class="card-header pb-0 text-left">
              <h5 class="font-weight-bolder text-info text-center text-gradient">SEMESTER REPORT CARD</h5>
              <hr>
            </div>
            <div class="card-body">
              <form role="form text-left" id="searchSemesterReport">
                <div class="input-group mb-3">
                  <select class="form-control" name="ta" required>
                    <option value="">Select Academic Year</option>
                    <?php foreach($ta->getResultArray() AS $t): ?>
                    <option value="<?=$t['kd_ta']?>"><?=$t['thn_akademik']." ".$t['semester'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <select class="form-control" name="kls" id="id_kls" required onchange="selectRombel('id_kls','id_rombel')">
                    <option value="">Select Class</option>
                    <?php foreach($kls->getResultArray() AS $kl): ?>
                    <option value="<?=$kl['id_kelas']?>"><?=$kl['romawi'];?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <select class="form-control" name="rombel" id="id_rombel" required>
                    <option value="">Select Rombel Class</option>
                    <option value=""></option>
                  </select>
                </div>
                <input type="hidden" name="id" value="<?=session()->get('id');?>">
                <div class="text-center">
                  <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0"><i class="fa fa-search">&nbsp;</i> Search</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?= $this->endSection(); ?>
  
  