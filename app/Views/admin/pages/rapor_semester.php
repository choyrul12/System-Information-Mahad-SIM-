<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIM IHBS | Rapor Semester</title>
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/adminlte.min.css">
    <style>
        @page {
            size: A4 portrait;
             margin: 5% 5% 5% 5%; 
        }

        @media print {
            * {
                font-family: "Times New Roman", Times, serif;
            }

            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }

            .title {
                margin-top: 0px;
                margin-bottom: 0px;
                margin-left: 40px;
                font-size: 28px;
            }

            .address {
                margin-top: 5px;
                font-size: 15px;
                margin-left: 40px;
            }

            .logo-rapor {
                width: 450px;
                display: list-item;
                /* list-style-position: inside; */
                margin-left: 1px;
                position: absolute;
            }

            hr {
                margin: 1px;
                height: 1px;
                border-color: #000;
            }

            .score {
                padding-top: 0px;
            }

            .score table {
                border: 1px solid black;
                border-collapse: collapse;
                /*margin: 5px;*/
            }

            .score tr {
                border: 1px solid black;
                border-collapse: collapse;
            }

            .score td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                font-size: 16px;
            }

            .score th {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                font-size: 16px;
                text-align: center;
            }

            .profil td {
                font-size: 16px;
                font-weight: 600;
                margin: 0;
            }

            .paper {
                border-style: solid;
                border-color: #515E63;
                /*background:#EEEEEE;*/
                padding: 12px;
                margin-top: 0px;
                margin-bottom: 0px;
                min-height: 1423px;
            }

            .ttd-kepsek {
                width: 280px;
                top: -50px;
                left: 300px;
                position: absolute;
            }

            .ttd {
                font-size: 17px;
                /* padding-top:100px; */
            }
            
        }

        @media only screen and (min-width: 768px) {
            * {
                font-family: "Times New Roman", Times, serif;
            }
            
            body{
                margin: 0px 20px;
            }

            #print_area {
                display: block;
                border-color: coral;
                border: 10px;
            }

            .paper {
                border-style: solid;
                border-color: #515E63;
                background: #F9F9F9;
                padding: 20px;
                margin-bottom: 15px;
                min-height: 1410px;
            }

            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }

            .title {
                margin-top: 0px;
                margin-bottom: 0px;
                margin-left: 40px;
                font-size: 28px;
            }

            .address {
                margin-top: 5px;
                font-size: 13px;
                margin-left: 40px;
            }

            /*.logo-rapor{*/
            /* width:555px;*/
            /* display: list-item;*/
            /* list-style-position: inside; */
            /* margin-left: 15px;*/
            /* padding-right: 30px;*/
            /* position: absolute;*/
            /*}*/
            hr {
                margin: 1px;
                height: 1px;
                border-color: #000;
            }

            .score {
                padding-top: 0px;
            }

            .score table {
                border: 1px solid black;
                border-collapse: collapse;
                margin: 5px;
            }

            .score tr {
                border: 1px solid black;
                border-collapse: collapse;
            }

            .score td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                font-size: 15px;
            }

            .score th {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                font-size: 16px;
                text-align: center;
            }

            .profil td {
                font-size: 16px;
                font-weight: 600;
                margin: 0;
            }
        }

        .logo-rapor {
            width: 170px;
            float: left;
            padding-left: 50px;
            /*padding-top: 2px;*/
            display: list-item;
            position: absolute;
        }

        hr {
            height: 2px;
            margin: 2px;
        }

        /*body{margin:2% 2% 2% 2%;}*/

        .mt-8 {
            margin-top: 120px;
        }
    </style>
</head>

<body>
    <?php

    use phpDocumentor\Reflection\Types\Null_;

    $ta = new App\Models\ThnAkademikModel;
    $pesdik = new App\Models\PesdikModel;
    $rombel = new App\Models\RombelModel;
    $mapel = new App\Models\MapelModel;
    $nilai = new App\Models\NilaiAfektifModel;
    $kkm = new App\Models\GradeModel;
    $std = new App\Models\AfektifModel;
    $dataRapor = new App\Models\RaporSemesterModel();
    $absensi = new App\Models\AbsensiModel(); ?>
    <?php $ta = $ta->getDataThnAkademikById($_GET['ta']);
    $pesdik = $pesdik->getDataPesdikById($_GET['id'])->getRow();
    $rombel = $rombel->getDataRombelById($_GET['rombel'])->getRow();
    $mapel = $mapel->getDataMapelByKls($_GET['kls']);
    $kkm = $kkm->getKkm(session()->get('unit'));
    $dr = $dataRapor->getDataRapor($_GET['ta'], $_GET['rombel']); ?>
    <!--<div class="modal-body" id="print_area">-->
        <div class="paper"> <img class="logo-rapor" src="<?= base_url('assets/img/favicon.png') ?>">
            <h1 class="text-center title">YAYASAN DAKWAH ISLAM CAHAYA ILMU</h1>
            <h2 class="text-center title">
                <?= $dr->nm_sekolah ?>
            </h2>
            <p class="text-center address">
                <?= $dr->alamat ?><br>Telp./Fax: ( 021) 843122779 Website: http://ihbs.sch.id | E-mail: smp.ihbsjakarta@gmail.com</p>
            <hr>
            <hr>
            <h4 class="text-center mt-3">STUDENT ACHIEVEMENT REPORT <br>ACADEMIC YEAR
                <?= $ta->thn_akademik ?>
            </h4>
            <div class="profil">
                <table width='100%' class="">
                    <tr>
                        <td>School Name</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $dr->nm_sekolah ?>
                        </td>
                        <td width='5%'></td>
                        <td>Class</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $rombel->nm_rombel ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Number</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $pesdik->nisn ?>
                        </td>
                        <td width='5%'></td>
                        <td>Semester</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $ta->semester ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Name</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $pesdik->nm_pesdik ?>
                        </td>
                        <td width='5%'></td>
                        <td>Academic Year</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $ta->thn_akademik ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="row score mt-4">
                <div class="col-12 mb-3">
                    <h5>A. Sikap</h5>
                    <h5>1. Sikap Spiritual</h5>
                </div>
                <div class="col-12">
                    <table style="border: 1px; width:100%;">
                        <thead>
                            <th width='25%'><b>Predikat / Grade</b></th>
                            <th><b>Deskripsi / Description</b></th>
                        </thead>
                        <tbody>
                            <?php $n = $nilai->getDataNilaiAfektifByNisn($pesdik->nisn, $_GET['ta']) ?>
                            <?php $desk = $std->getDeskripsiAfektif("SPIRITUAL", $n->spiritual) ?>
                            <td style="padding-top: 50px; padding-bottom:50px;" class="text-center"><b><?= $n->spiritual ?></b></td>
                            <td style="padding-top: 50px; padding-bottom:50px;" class="text-center"><b><?= $desk->deskripsi ?></b></td>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mb-3 mt-5">
                    <h5>2. Sikap Sosial</h5>
                </div>
                <div class="col-12">
                    <table style="border: 1px; width:100%;">
                        <thead>
                            <th width='25%'><b>Predikat / Grade</b></th>
                            <th><b>Deskripsi / Description</b></th>
                        </thead>
                        <tbody>
                            <?php $n = $nilai->getDataNilaiAfektifByNisn($pesdik->nisn, $_GET['ta']) ?>
                            <?php $desk = $std->getDeskripsiAfektif("SOSIAL", $n->sosial) ?>
                            <td style="padding-top: 50px; padding-bottom:50px;" class="text-center"><b><?= $n->sosial ?></b></td>
                            <td style="padding-top: 50px; padding-bottom:50px;" class="text-center"><b><?= $desk->deskripsi ?></b></td>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-5 text-left">
                    <table width="20%">
                        <tr>
                            <td><b>Predikat :</b></td>
                        </tr>
                        <tr>
                            <td>1. Sangat Baik <br>2. Baik <br>3. Cukup</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="paper">
            <?php $ta = new App\Models\ThnAkademikModel;
            $pesdik = new App\Models\PesdikModel;
            $rombel = new App\Models\RombelModel;
            $mapel = new App\Models\MapelModel;
            $nilai = new App\Models\NilaiMapelModel;
            $kkm = new App\Models\GradeModel;
            $dataRapor = new App\Models\RaporSemesterModel();
            $grade = new App\Models\GradeModel();
            $desk = new App\Models\StdPengetahuanModel(); ?>
            <?php $ta = $ta->getDataThnAkademikById($_GET['ta']);
            $pesdik = $pesdik->getDataPesdikById($_GET['id'])->getRow();
            $rombel = $rombel->getDataRombelById($_GET['rombel'])->getRow();
            $kkm = $kkm->getKkm(session()->get('unit'));
            $dr = $dataRapor->getDataRapor($_GET['ta'], $_GET['rombel']); ?> <img class="logo-rapor" src="<?= base_url('assets/img/favicon.png') ?>">
            <h1 class="text-center title">YAYASAN DAKWAH ISLAM CAHAYA ILMU</h1>
            <h2 class="text-center title">
                <?= $dr->nm_sekolah ?>
            </h2>
            <p class="text-center address">
                <?= $dr->alamat ?><br>Telp./Fax: ( 021) 843122779 Website: http://ihbs.sch.id | E-mail: smp.ihbsjakarta@gmail.com</p>
            <hr>
            <hr>
            <h4 class="text-center mt-3">STUDENT ACHIEVEMENT REPORT <br>ACADEMIC YEAR
                <?= $ta->thn_akademik ?>
            </h4>
            <div class="profil">
                <table width='100%' class="">
                    <tr>
                        <td>School Name</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $dr->nm_sekolah ?>
                        </td>
                        <td width='5%'></td>
                        <td>Class</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $rombel->nm_rombel ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Number</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $pesdik->nisn ?>
                        </td>
                        <td width='5%'></td>
                        <td>Semester</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $ta->semester ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Name</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $pesdik->nm_pesdik ?>
                        </td>
                        <td width='5%'></td>
                        <td>Academic Year</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $ta->thn_akademik ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="row score mt-4">
                <div class="col-5 mb-3">
                    <h5>B. Pengetahuan</h5>
                </div>
                <div class="col-2 mb-3"></div>
                <div class="col-5 mb-3 text-right">
                    <h5>KKM :
                        <?= $kkm->standard; ?>
                    </h5>
                </div>
                <div class="col-12">
                    <table style="border: 1px; width:100%;">
                        <thead>
                            <th width="5%"><b>NO</b></th>
                            <th width="20%"><b>MATA PELAJARAN / SUBJECT</b></th>
                            <th width="8%"><b>Nilai / Score</b></th>
                            <th width="8%"><b>Predikat / Grade</b></th>
                            <th><b>Deskripsi / Description</b></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" style="background-color: gainsboro;"><b>KELOMPOK A</b></td>
                            </tr>
                            <?php $kelA = $mapel->getDataMapelByKelompok($_GET['kls'], "A"); ?>
                            <?php $total = 0;
                            $no = 1;
                            foreach ($kelA->getResultArray() as $m) : ?>
                                <?php $n = $nilai->getDataNilaiByMapel($m['kd_mapel'], $pesdik->nisn, $_GET['ta']); ?>
                                <?php if (empty($n->na)) {
                                    $na = 0;
                                } else {
                                    $na = $n->na;
                                }?>
                                <?php $g = $grade->getGradeByScore($na); ?>
                                <?php $d = $desk->getDeskripsiByMapel($m['kd_mapel']) ?>
                                <?php
                                switch ($g->grade) {
                                    case 'A':
                                        $desc = $d->grade_a;
                                        break;
                                    case 'B':
                                        $desc = $d->grade_b;
                                        break;
                                    case 'C':
                                        $desc = $d->grade_c;
                                        break;
                                    case 'D':
                                        $desc = $d->grade_d;
                                        break;
                                } ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?= $m['nm_mapel'] . "<br><i>" . $m['nm_mapel_ing'];
                                        "</i>" ?></td>
                                    <td class="text-center" style="color:<?= ($na < $kkm->standard) ? '#B61919;' : '#000;'; ?>">
                                        <?= round($na); ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $g->grade; ?>
                                    </td>
                                    <td>
                                        <?= $desc; ?>
                                    </td>
                                    <?php $total += $na; ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5" style="background-color: gainsboro;"><b>KELOMPOK B</b></td>
                            </tr>
                            <?php $kelB = $mapel->getDataMapelByKelompok($_GET['kls'], "B"); ?>
                            <?php foreach ($kelB->getResultArray() as $m) : ?>
                                <?php $n = $nilai->getDataNilaiByMapel($m['kd_mapel'], $pesdik->nisn, $_GET['ta']); ?>
                                <?php if (empty($n->na)) {
                                    $na = 0;
                                } else {
                                    $na = $n->na;
                                }?>
                                <?php $g = $grade->getGradeByScore($na); ?>
                                <?php $d = $desk->getDeskripsiByMapel($m['kd_mapel']) ?>
                                <?php
                                switch ($g->grade) {
                                    case 'A':
                                        $desc = $d->grade_a;
                                        break;
                                    case 'B':
                                        $desc = $d->grade_b;
                                        break;
                                    case 'C':
                                        $desc = $d->grade_c;
                                        break;
                                    case 'D':
                                        $desc = $d->grade_d;
                                        break;
                                } ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?= $m['nm_mapel'] . "<br><i>" . $m['nm_mapel_ing'];
                                        "</i>" ?></td>
                                    <td class="text-center" style="color:<?= ($na < $kkm->standard) ? '#B61919;' : '#000;'; ?>">
                                        <?= round($na) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $g->grade; ?>
                                    </td>
                                    <td>
                                        <?= $desc; ?>
                                    </td>
                                    <?php $total += $na; ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5" style="background-color: gainsboro;"><b>KELOMPOK C</b></td>
                            </tr>
                            <?php $kelC = $mapel->getDataMapelByKelompok($_GET['kls'], "C"); ?>
                            <?php foreach ($kelC->getResultArray() as $m) : ?>
                                <?php $n = $nilai->getDataNilaiByMapel($m['kd_mapel'], $pesdik->nisn, $_GET['ta']); ?>
                                <?php if (empty($n->na)) {
                                    $na = 0;
                                } else {
                                    $na = $n->na;
                                }?>
                                <?php $g = $grade->getGradeByScore($na); ?>
                                <?php $d = $desk->getDeskripsiByMapel($m['kd_mapel']) ?>
                                <?php
                                switch ($g->grade) {
                                    case 'A':
                                        $desc = $d->grade_a;
                                        break;
                                    case 'B':
                                        $desc = $d->grade_b;
                                        break;
                                    case 'C':
                                        $desc = $d->grade_c;
                                        break;
                                    case 'D':
                                        $desc = $d->grade_d;
                                        break;
                                } ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?= $m['nm_mapel'] . "<br><i>" . $m['nm_mapel_ing'];
                                        "</i>" ?></td>
                                    <td class="text-center" style="color:<?= ($na < $kkm->standard) ? '#B61919;' : '#000;'; ?>">
                                        <?= round($na) ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $g->grade; ?>
                                    </td>
                                    <td>
                                        <?= $desc; ?>
                                    </td>
                                    <?php $total += $na; ?>
                                </tr>
                            <?php endforeach ?>
                            <tr style="background-color: gainsboro;">
                                <td colspan="2" class="text-center"><b>TOTAL AMOUNT :</b></td>
                                <td colspan="2" class="text-center"><b><?= round($total); ?></b></td>
                                <td class="text-center"><b>AVERAGE : <?= number_format(round($total) / ($no - 1), 1) ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="6">Score Description: ( 93 - 100=A ) | ( 84 - 92=B ) | ( 75 - 83=C ) | (
                                    < 75=D ) </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="paper">
            <?php $ta = new App\Models\ThnAkademikModel;
            $pesdik = new App\Models\PesdikModel;
            $rombel = new App\Models\RombelModel;
            $mapel = new App\Models\MapelModel;
            $nilai = new App\Models\NilaiMapelModel;
            $kkm = new App\Models\GradeModel;
            $dataRapor = new App\Models\RaporSemesterModel();
            $grade = new App\Models\GradeModel();
            $desk = new App\Models\StdKeterampilanModel(); ?>
            <?php $ta = $ta->getDataThnAkademikById($_GET['ta']);
            $pesdik = $pesdik->getDataPesdikById($_GET['id'])->getRow();
            $rombel = $rombel->getDataRombelById($_GET['rombel'])->getRow();
            $kkm = $kkm->getKkm(session()->get('unit'));
            $dr = $dataRapor->getDataRapor($_GET['ta'], $_GET['rombel']); ?> <img class="logo-rapor" src="<?= base_url('assets/img/favicon.png') ?>">
            <h1 class="text-center title">YAYASAN DAKWAH ISLAM CAHAYA ILMU</h1>
            <h2 class="text-center title">
                <?= $dr->nm_sekolah ?>
            </h2>
            <p class="text-center address">
                <?= $dr->alamat ?><br>Telp./Fax: ( 021) 843122779 Website: http://ihbs.sch.id | E-mail: smp.ihbsjakarta@gmail.com</p>
            <hr>
            <hr>
            <h4 class="text-center mt-3">STUDENT ACHIEVEMENT REPORT <br>ACADEMIC YEAR
                <?= $ta->thn_akademik ?>
            </h4>
            <div class="profil">
                <table width='100%' class="">
                    <tr>
                        <td>School Name</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $dr->nm_sekolah ?>
                        </td>
                        <td width='5%'></td>
                        <td>Class</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $rombel->nm_rombel ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Number</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $pesdik->nisn ?>
                        </td>
                        <td width='5%'></td>
                        <td>Semester</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $ta->semester ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Name</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $pesdik->nm_pesdik ?>
                        </td>
                        <td width='5%'></td>
                        <td>Academic Year</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $ta->thn_akademik ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="row score mt-4">
                <div class="col-5 mb-3">
                    <h5>C. Keterampilan</h5>
                </div>
                <div class="col-2 mb-3"></div>
                <div class="col-5 mb-3 text-right">
                    <h5>KKM :
                        <?= $kkm->standard; ?>
                    </h5>
                </div>
                <div class="col-12">
                    <table style="border: 1px; width:100%;">
                        <thead>
                            <th width="5%"><b>NO</b></th>
                            <th width="20%"><b>MATA PELAJARAN / SUBJECT</b></th>
                            <th width="8%"><b>Nilai / Score</b></th>
                            <th width="8%"><b>Predikat / Grade</b></th>
                            <th><b>Deskripsi / Description</b></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" style="background-color: gainsboro;"><b>KELOMPOK A</b></td>
                            </tr>
                            <?php $kelA = $mapel->getDataMapelByKelompok($_GET['kls'], "A"); ?>
                            <?php $total = 0;
                            $no = 1;
                            foreach ($kelA->getResultArray() as $m) : ?>
                                <?php $n = $nilai->getDataNilaiByMapel($m['kd_mapel'], $pesdik->nisn, $_GET['ta']); ?>
                                <?php if (empty($n->keterampilan)) {
                                    $na = 0;
                                } else {
                                    $na = $n->keterampilan;
                                }?>
                                <?php $g = $grade->getGradeByScore($na); ?>
                                <?php $d = $desk->getDeskripsiByMapel($m['kd_mapel']) ?>
                                <?php
                                switch ($g->grade) {
                                    case 'A':
                                        $desc = $d->grade_a;
                                        break;
                                    case 'B':
                                        $desc = $d->grade_b;
                                        break;
                                    case 'C':
                                        $desc = $d->grade_c;
                                        break;
                                    case 'D':
                                        $desc = $d->grade_d;
                                        break;
                                } ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?= $m['nm_mapel'] . "<br><i>" . $m['nm_mapel_ing'];
                                        "</i>" ?></td>
                                    <td class="text-center" style="color:<?= ($na < $kkm->standard) ? '#B61919;' : '#000;'; ?>">
                                        <?= round($na); ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $g->grade; ?>
                                    </td>
                                    <td>
                                        <?= $desc; ?>
                                    </td>
                                    <?php $total += $n->keterampilan; ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5" style="background-color: gainsboro;"><b>KELOMPOK B</b></td>
                            </tr>
                            <?php $kelB = $mapel->getDataMapelByKelompok($_GET['kls'], "B"); ?>
                            <?php foreach ($kelB->getResultArray() as $m) : ?>
                                <?php $n = $nilai->getDataNilaiByMapel($m['kd_mapel'], $pesdik->nisn, $_GET['ta']); ?>
                                <?php if (empty($n->keterampilan)) {
                                    $na = 0;
                                } else {
                                    $na = $n->keterampilan;
                                }?>
                                <?php $g = $grade->getGradeByScore($na); ?>
                                <?php $d = $desk->getDeskripsiByMapel($m['kd_mapel']) ?>
                                <?php
                                switch ($g->grade) {
                                    case 'A':
                                        $desc = $d->grade_a;
                                        break;
                                    case 'B':
                                        $desc = $d->grade_b;
                                        break;
                                    case 'C':
                                        $desc = $d->grade_c;
                                        break;
                                    case 'D':
                                        $desc = $d->grade_d;
                                        break;
                                } ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?= $m['nm_mapel'] . "<br><i>" . $m['nm_mapel_ing'];
                                        "</i>" ?></td>
                                    <td class="text-center" style="color:<?= ($na < $kkm->standard) ? '#B61919;' : '#000;'; ?>">
                                        <?= $na ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $g->grade; ?>
                                    </td>
                                    <td>
                                        <?= $desc; ?>
                                    </td>
                                    <?php $total += $n->keterampilan; ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5" style="background-color: gainsboro;"><b>KELOMPOK C</b></td>
                            </tr>
                            <?php $kelC = $mapel->getDataMapelByKelompok($_GET['kls'], "C"); ?>
                            <?php foreach ($kelC->getResultArray() as $m) : ?>
                                <?php $n = $nilai->getDataNilaiByMapel($m['kd_mapel'], $pesdik->nisn, $_GET['ta']); ?>
                                <?php if (empty($n->keterampilan)) {
                                    $na = 0;
                                } else {
                                    $na = $n->keterampilan;
                                }?>
                                <?php $g = $grade->getGradeByScore($na); ?>
                                <?php $d = $desk->getDeskripsiByMapel($m['kd_mapel']) ?>
                                <?php 
                                switch ($g->grade) {
                                    case 'A':
                                        $desc = $d->grade_a;
                                        break;
                                    case 'B':
                                        $desc = $d->grade_b;
                                        break;
                                    case 'C':
                                        $desc = $d->grade_c;
                                        break;
                                    case 'D':
                                        $desc = $d->grade_d;
                                        break;
                                } ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?= $m['nm_mapel'] . "<br><i>" . $m['nm_mapel_ing'];
                                        "</i>" ?></td>
                                    <td class="text-center" style="color:<?= ($na < $kkm->standard) ? '#B61919;' : '#000;'; ?>">
                                        <?= $na ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $g->grade; ?>
                                    </td>
                                    <td>
                                        <?= $desc; ?>
                                    </td>
                                    <?php $total += $n->keterampilan; ?>
                                </tr>
                            <?php endforeach ?>
                            <tr style="background-color: gainsboro;">
                                <td colspan="2" class="text-center"><b>TOTAL AMOUNT :</b></td>
                                <td colspan="2" class="text-center"><b><?= round($total); ?></b></td>
                                <td class="text-center"><b>AVERAGE : <?= number_format($total / ($no - 1), 1) ?></b></td>
                            </tr>
                            <tr>
                                <td colspan="6">Score Description: ( 93 - 100=A ) | ( 84 - 92=B ) | ( 75 - 83=C ) | (
                                    < 75=D ) </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="paper">
            <?php $ta = new App\Models\ThnAkademikModel;
            $pesdik = new App\Models\PesdikModel;
            $rombel = new App\Models\RombelModel;
            $mapel = new App\Models\MapelModel;
            $nilai = new App\Models\NilaiEskulModel;
            $kkm = new App\Models\GradeModel;
            $dataRapor = new App\Models\RaporSemesterModel();
            $grade = new App\Models\StdEskulModel();
            $desk = new App\Models\StdPengetahuanModel();
            $absensi = new App\Models\AbsensiModel(); ?>
            <?php $ta = $ta->getDataThnAkademikById($_GET['ta']);
            $pesdik = $pesdik->getDataPesdikById($_GET['id'])->getRow();
            $rombel = $rombel->getDataRombelById($_GET['rombel'])->getRow();
            $kkm = $kkm->getKkm(session()->get('unit'));
            $dr = $dataRapor->getDataRapor($_GET['ta'], $_GET['rombel']);
            $absensi = $absensi->getDataAbsensiByNisn($pesdik->nisn, $_GET['ta']); ?> <img class="logo-rapor" src="<?= base_url('assets/img/favicon.png') ?>">
            <h1 class="text-center title">YAYASAN DAKWAH ISLAM CAHAYA ILMU</h1>
            <h2 class="text-center title">
                <?= $dr->nm_sekolah ?>
            </h2>
            <p class="text-center address">
                <?= $dr->alamat ?><br>Telp./Fax: ( 021) 843122779 Website: http://ihbs.sch.id | E-mail: smp.ihbsjakarta@gmail.com</p>
            <hr>
            <hr>
            <h4 class="text-center mt-3">STUDENT ACHIEVEMENT REPORT <br>ACADEMIC YEAR
                <?= $ta->thn_akademik ?>
            </h4>
            <div class="profil">
                <table width='100%' class="">
                    <tr>
                        <td>School Name</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $dr->nm_sekolah ?>
                        </td>
                        <td width='5%'></td>
                        <td>Class</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $rombel->nm_rombel ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Number</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $pesdik->nisn ?>
                        </td>
                        <td width='5%'></td>
                        <td>Semester</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $ta->semester ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Student Name</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $pesdik->nm_pesdik ?>
                        </td>
                        <td width='5%'></td>
                        <td>Academic Year</td>
                        <td width='2px'>:</td>
                        <td>
                            <?= $ta->thn_akademik ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="row score mt-4">
                <div class="col-5 mb-3">
                    <h5>D. Ekstrakurikuler</h5>
                </div>
                <div class="col-2 mb-3"></div>
                <div class="col-5 mb-3 text-right">
                    <h5>KKM :
                        <?= $kkm->standard; ?>
                    </h5>
                </div>
                <div class="col-12">
                    <table style="border: 1px; width:100%;">
                        <thead>
                            <th width="3%"><b>NO</b></th>
                            <th width="20%"><b>KEGIATAN EKSTRAKURIKULER</b></th>
                            <th width="10%"><b>Nilai / Score</b></th>
                            <th width="10%"><b>Predikat / Grade</b></th>
                        </thead>
                        <tbody>
                            <?php $n = $nilai->getNilaiEskulByNisn($pesdik->nisn, $_GET['ta']); ?>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <?= $n->eskul1; ?>
                                </td>
                                <td class="text-center">
                                    <?= $n->nilai1; ?>
                                </td>
                                <td class="text-center">
                                    <?= ($n->nilai1 != '') ? $grade->getGradeByScore($n->nilai1)->grade : ""; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td class="text-center">
                                    <?= $n->eskul2; ?>
                                </td>
                                <td class="text-center">
                                    <?= $n->nilai2; ?>
                                </td>
                                <td class="text-center">
                                    <?= ($n->nilai2 != '') ? $grade->getGradeByScore($n->nilai2)->grade : ""; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td class="text-center">
                                    <?= $n->eskul3; ?>
                                </td>
                                <td class="text-center">
                                    <?= $n->nilai3; ?>
                                </td>
                                <td class="text-center">
                                    <?= ($n->nilai3 != '') ? $grade->getGradeByScore($n->nilai3)->grade : ""; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td class="text-center">
                                    <?= $n->eskul4; ?>
                                </td>
                                <td class="text-center">
                                    <?= $n->nilai4; ?>
                                </td>
                                <td class="text-center">
                                    <?= ($n->nilai4 != '') ? $grade->getGradeByScore($n->nilai4)->grade : ""; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-5 mb-3 mt-3">
                    <h5>E. Ketidakhadiran</h5>
                </div>
                <div class="col-12 text-left">
                    <table width="50%">
                        <tr>
                            <td width="50%">Sakit</td>
                            <td align="center">
                                <?= $absensi->sakit ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Izin</td>
                            <td align="center">
                                <?= $absensi->izin ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanpa Keterangan</td>
                            <td align="center">
                                <?= $absensi->alpha ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-12 mt-8 text-center ttd">
                    <p>Acknowledge By</p>
                </div>
                <div class="col-4 text-left ttd">
                    <p class="text-center"><br>Parents</p>
                    <p class="mt-8 text-center"><b>(_________________)</b></p>
                </div>
                <div class="col-4"> </div>
                <div class="col-4 text-right ttd">
                    <p class="text-center">
                        <?= $dr->kota_terbit; ?>,&nbsp;
                        <?= date('d F Y', strtotime($dr->tgl_terbit)) ?> <br>Homeroom Teacher</p>
                    <p class="mt-8 text-center"><b><?= $dr->username; ?></b></p>
                </div>
                <div class="col-12 text-center ttd">
                    <p class="text-center" >Principal</p>
                    <p class="mt-8 text-center" ><b><?= $dr->nm_kepsek; ?></b></p>
                </div>
            </div>
        </div>
    <!--</div>-->
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function($) {
        var ua = navigator.userAgent.toLowerCase();
        var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
        //   $('#test').load(function() {
        // e.preventDefault();
        if (isAndroid) {
            // https://developers.google.com/cloud-print/docs/gadget
            var gadget = new cloudprint.Gadget();
            gadget.setPrintDocument("url", $('title').html(), window.location.href, "utf-8");
            gadget.openPrintDialog();
        } else {

            window.print();
            window.onafterprint = function() {
                window.close(), history.go(-1);
            }
        }
        // return false;
        //   });
    });
</script>