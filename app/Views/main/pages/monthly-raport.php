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
          <div class="text-center">
            <h3 class="text-gradient text-primary">MONTHLY RAPORT</h3>
            <p class="mb-0">
              Data nilai bulanan peserta didik.
            </p>
          </div>
          <hr>
          <div class="col-lg-8 d-flex justify-content-center flex-column ms-auto me-auto">
            <div class="row">
              <div class="form-group col-md-5">
                <select class="form-control">
                  <option value="">Select Academic Year</option>
                </select>
              </div>
              <div class="form-group col-md-5">
                <input type="month" class="form-control">
              </div>
              <div class="form-group col-md-2">
                <button class="btn btn-primary btn-block"><i class="fa fa-search"></i> SEARCH</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<?= $this->endSection(); ?>