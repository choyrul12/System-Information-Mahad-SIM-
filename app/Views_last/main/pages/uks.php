<?= $this->extend('main/layout/template'); ?>
<?= $this->section('content'); ?>
<header class="header-2">
    <div class="page-header section-height-30 relative" style="background-image: url('./assets/img/header.jpg')">
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
    <div class="container py-5 postion-relative z-index-2 position-relative">
      <div class="col-lg-11 d-flex justify-content-center flex-column ms-auto me-auto">
        <div class="card d-flex blur justify-content-center p-4 shadow-lg my-sm-0 my-sm-6 mt-8 mb-5">
          
          <div class="row">
            <div class="col-lg-5 col-md-6 col-12 pe-lg-0 mx-4 d-flex justify-content-center flex-column ms-auto me-auto text-center">
              <a href="javascript:;">
                <div class="pe-0">
                  <img class="w-30 border-radius-section" src="./assets/img/avatar.png">
                </div>
              </a>
              <h5 class="mt-2"><?= session()->get('username'); ?></h5>
            </div>
          </div>
          <hr>
          <div class="text-center">
            <h3 class="text-gradient text-primary">HEALTH REPORT</h3>
            <p class="mb-0">
            Information about student medical records.
            </p>
          </div>
          <?php if($rekam_medis->getNumRows()===0): ?>
          <div class="text-center mt-6 mb-8">
            <h4 class="text-center">Alhamdulillah, <?= session()->get('username'); ?> is still healthy and <br> doesn't have a medical record</h4 >
          </div>
          <?php endif; ?>
          <?php if($rekam_medis->getNumRows()>0): ?>
          <ul class="timeline mt-6 mb-6">
          <?php $n1 = 1; $n2 = 1; foreach($rekam_medis->getResultArray() AS $rm): ?>
            <li>
              <div class="timeline-time">
                  <span class="date"><?= date("d M Y",strtotime($rm['tgl_periksa'])) ?></span>
                  <!-- <span class="time"><?= $rm['tgl_periksa'] ?></span> -->
              </div>
              <div class="timeline-icon">
                  <a href="javascript:;">&nbsp;</a>
              </div>
              <div class="timeline-body">
                  <div class="timeline-header">
                    <span class="username"><?= $rm['diagnosis'] ?></span>
                    <button class="btn btn-sm btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#detail-healt-report<?=$n1++;?>"><i class="fa fa-list"></i></button>
                  </div>
                  <div class="timeline-content">
                    <p>Anamnesa :</p>
                    <p class="lead">
                        <i class="fa fa-quote-left fa-fw pull-left"></i>
                        <?= $rm['anamnesa'] ?>
                        <i class="fa fa-quote-right fa-fw pull-right"></i>
                    </p>
                  </div>
              </div>
            </li>
            
          <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
</section>
<?php $n1 = 1;foreach($rekam_medis->getResultArray() AS $rm): ?>
  <div class="modal fade" id="detail-healt-report<?= $n1++; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-title-default">(<?= date("d M Y",strtotime($rm['tgl_periksa'])) ?>) <?=$rm['diagnosis']?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: grey;">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <p>Anamnesa :</p>
        <p class="lead"><?= $rm['anamnesa'] ?></p>
        <hr>
        <p>Penanganan :</p>
        <p class="lead"><?= $rm['penanganan'] ?></p>
        <hr>
        <p>Obat :</p>
        <p class="lead"><?= $rm['obat'] ?></p>
        <hr>
        <p>Note :</p>
        <p class="lead"><?= $rm['note'] ?></p>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>