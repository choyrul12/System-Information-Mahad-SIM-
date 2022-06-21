<?= $this->extend('admin/layout/template'); ?>
<?= $this->section('content'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card bg-white">
                    <div class="card-header text-muted border-bottom-0">
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-5 text-center">
                            <img src="<?= base_url('/assets/images/avatar.png') ?>" alt="" class="img-circle img-fluid">
                            </div>
                            <div class="col-7">
                            <h2 class="lead"><b><?=$profile->nm_pesdik;?></b></h2>
                            <b class="text-muted text-md"><?=$profile->rombel;?></b>
                            <ul class="ml-3 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"><i class="fas fa-sm fa-bookmark"></i></span> NIK : <?=$profile->nik?></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-sm fa-bookmark"></i></span> NISN : <?=$profile->nisn?></li>
                                <li class="small"><span class="fa-li"><i class="fas fa-sm fa-bookmark"></i></span> NIPD : <?=$profile->nipd?></li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                        <strong><i class="fas fa-calendar-alt mr-1"></i>Tempat, Tanggal Lahir</strong>
                        <p class="text-muted">
                            <?=$profile->tpt_lahir;?>, <?= date("d-m-Y", strtotime($profile->tgl_lahir)); ?>
                        </p>
                        <hr>
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                        <p class="text-muted"><?= $profile->alamat; ?>, RT <?=$profile->rt?> Rw <?=$profile->rw?>, <?=$profile->dusun;?>, <?=$profile->kecamatan;?></p>
                        <hr>
                        <strong><i class="fas fa-phone-alt mr-1"></i> No Telepon</strong>
                        <p class="text-muted"><?=$profile->no_tlp; ?></p>
                        <hr>
                        <strong><i class="fas fa-mobile-alt mr-1"></i> No Handphone</strong>
                        <p class="text-muted"><?=$profile->no_hp; ?></p>
                        <hr>
                        <strong><i class="fas fa-university mr-1"></i> Asal Sekolah</strong>
                        <p class="text-muted"><?=$profile->sekolah_asal; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="data-ayah">
                                <div class="row">
                                    <div class="col-12">
                                        <h5><strong>Data Ayah</strong></h5><hr>
                                    </div>
                                    <div class="col-6">
                                        <strong><i class="fas fa-user-circle mr-1"></i>Nama Ayah</strong>
                                        <p class="text-muted">
                                            <?= $profile->nm_ayah;?>&nbsp;
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-graduation-cap mr-1"></i> Pendidikan</strong>
                                        <p class="text-muted"><?= $profile->pendidikan_ayah; ?>&nbsp;</p>
                                        <hr>
                                    </div>
                                    <div class="col-6">
                                        <strong><i class="fas fa-calendar-alt mr-1"></i>Tahun Lahir&nbsp;</strong>
                                        <p class="text-muted">
                                            <?=$profile->thn_lahir_ayah?>
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-briefcase mr-1"></i> Pekerjaan</strong>
                                        <p class="text-muted"><?= $profile->pekerjaan_ayah; ?>&nbsp;</p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5><strong>Data Ibu</strong></h5><hr>
                                    </div>
                                    <div class="col-6">
                                        <strong><i class="fas fa-user-circle mr-1"></i>Nama ibu</strong>
                                        <p class="text-muted">
                                            <?= $profile->nm_ibu;?>&nbsp;
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-graduation-cap mr-1"></i> Pendidikan</strong>
                                        <p class="text-muted"><?= $profile->pendidikan_ibu; ?>&nbsp;</p>
                                        <hr>
                                    </div>
                                    <div class="col-6">
                                        <strong><i class="fas fa-calendar-alt mr-1"></i>Tahun Lahir</strong>
                                        <p class="text-muted">
                                            <?=$profile->thn_lahir_ibu?>&nbsp;
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-briefcase mr-1"></i> Pekerjaan</strong>
                                        <p class="text-muted"><?= $profile->pekerjaan_ibu; ?>&nbsp;</p>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5><strong>Data Wali</strong></h5><hr>
                                    </div>
                                    <div class="col-6">
                                        <strong><i class="fas fa-user-circle mr-1"></i>Nama wali</strong>
                                        <p class="text-muted">
                                            <?= $profile->nm_wali;?>&nbsp;
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-graduation-cap mr-1"></i> Pendidikan</strong>
                                        <p class="text-muted"><?= $profile->pendidikan_wali; ?>&nbsp;</p>
                                        <hr>
                                    </div>
                                    <div class="col-6">
                                        <strong><i class="fas fa-calendar-alt mr-1"></i>Tahun Lahir</strong>
                                        <p class="text-muted">
                                            <?=$profile->thn_lahir_wali?>&nbsp;
                                        </p>
                                        <hr>
                                        <strong><i class="fas fa-briefcase mr-1"></i> Pekerjaan</strong>
                                        <p class="text-muted"><?= $profile->pekerjaan_wali; ?>&nbsp;</p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>