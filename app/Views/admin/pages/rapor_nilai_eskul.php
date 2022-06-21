<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIM-IHBS | Rapor Eskul</title>
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/adminlte.min.css">
    <style>
        @page {
            size: A4 portrait;
            /* margin: 3%; */
        }
        @media print {
            #print_area{
                display:block;
            }
            .text-center{
                text-align: center;
            }
            .text-right{
                text-align: right;
            }
            .title{
                margin-top: 0px;
                margin-bottom: 0px;
                margin-left: 40px;
                font-size: 30px;
            }
            .address{
                margin-top: 5px;
                font-size: 16px;
                margin-left: 40px;
            } 

            .logo-rapor{
                width:555px;
                display: list-item;
                /* list-style-position: inside; */
                margin-left: 15px;
                padding-right: 30px;
                position: absolute;
            }
            hr{
                margin: 1px;
                height: 1px;
            }

            .score{
                padding-top: 0px;
            }

            .score table{
                border: 1px solid black;
                border-collapse: collapse;
                margin: 5px;
            }
            .score tr{
                border: 1px solid black;
                border-collapse: collapse;
            }
            .score td{
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                font-size: 15px;
            }
            .score th{
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                font-size: 16px;
                text-align: center;
            }
            .profil td{
                font-size: 16px;
                font-weight: 600;
                margin: 0;
            }
        }
        #print_area .logo-rapor{
            width: 19%;
            float: left;
            padding-left: 30px;
            padding-top: 2px;
        }
        hr{
            height: 2px;
            margin: 2px;
        }
        body{width: 50%; margin: auto; left: 50%; right: 50%;}
        .mt-8{margin-top: 120px;}
    </style>
</head>
<body>
    <?php   
        $ta = new App\Models\ThnAkademikModel;  
        $pesdik = new App\Models\PesdikModel; 
        $rombel = new App\Models\RombelModel;
        $mapel = new App\Models\MapelModel;
        $nilai = new App\Models\NilaiEskulModel;
        $kkm = new App\Models\GradeModel;
        $dataRapor = new App\Models\RaporSemesterModel();
        $grade = new App\Models\StdEskulModel();
        $desk = new App\Models\StdPengetahuanModel();
    ?>
    <?php
        $ta = $ta->getDataThnAkademikById($_GET['ta']); 
        $pesdik = $pesdik->getDataPesdikById($_GET['id'])->getRow();
        $rombel = $rombel->getDataRombelById($_GET['rombel'])->getRow();
        $kkm = $kkm->getKkm(session()->get('unit'));
        $dr = $dataRapor->getDataRapor($_GET['ta'],$_GET['rombel']);
    ?>
    <div class="modal-body" id="print_area"> 
        <img class="logo-rapor" src="<?= base_url('assets/img/favicon.png')?>">
        <h1 class="text-center title">YAYASAN DAKWAH ISLAM CAHAYA ILMU</h1><h2 class="text-center title"><?= $dr->nm_sekolah ?></h2>
        <p class="text-center address"><?= $dr->alamat?><br>Telp./Fax: ( 021) 843122779  Website: http://ihbs.sch.id | E-mail: smp.ihbsjakarta@gmail.com</p>
        <hr><hr>
        <!-- <h1 class="text-center">كشف الدرجات</h1> -->
        <h4 class="text-center mt-3">STUDENT ACHIEVEMENT REPORT <br> ACADEMIC YEAR <?= $ta->thn_akademik?></h4>
        <div class="profil">
            <table width='100%' class="">
                <tr>
                    <td>School Name</td>
                    <td width='2px'>:</td>
                    <td><?=$dr->nm_sekolah?></td>
                    <td width='5%'></td>
                    <td>Class</td>
                    <td width='2px'>:</td>
                    <td><?=$rombel->nm_rombel?></td>
                </tr>
                <tr>
                    <td>Student Number</td>
                    <td width='2px'>:</td>
                    <td><?=$pesdik->nisn?></td>
                    <td width='5%'></td>
                    <td>Semester</td>
                    <td width='2px'>:</td>
                    <td><?=$ta->semester?></td>
                </tr>
                <tr>
                    <td>Student Name</td>
                    <td width='2px'>:</td>
                    <td><?=$pesdik->nm_pesdik?></td>
                    <td width='5%'></td>
                    <td>Academic Year</td>
                    <td width='2px'>:</td>
                    <td><?=$ta->thn_akademik?></td>
                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            </table>
        </div>
        <div  class="row score mt-5">
            <div class="col-5 mb-3"><h5>C. Ekstrakurikuler</h5></div>
            <div class="col-2 mb-3"></div>
            <div class="col-5 mb-3 text-right"><h5>KKM : <?= $kkm->standard; ?></h5></div>
            <div class="col-12">
                <table style="border: 1px; width:100%;">
                    <thead>
                        <th width="3%"><b>NO</b></th>
                        <th width="20%"><b>KEGIATAN EKSTRAKURIKULER</b></th>
                        <th width="10%"><b>Nilai / Score</b></th>
                        <th width="10%"><b>Predikat / Grade</b></th>
                    </thead>
                    <tbody>
                        <?php $n = $nilai->getNilaiEskulByNisn($pesdik->nisn,$_GET['ta']) ;?>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center"><?= $n->eskul1; ?></td>
                            <td class="text-center"><?= $n->nilai1; ?></td>
                            <td class="text-center"><?=($n->nilai1 != '') ? $grade->getGradeByScore($n->nilai1)->grade : ""; ?></td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center"><?= $n->eskul2; ?></td>
                            <td class="text-center"><?= $n->nilai2; ?></td>
                            <td class="text-center"><?=($n->nilai2 != '') ? $grade->getGradeByScore($n->nilai2)->grade : ""; ?></td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center"><?= $n->eskul3; ?></td>
                            <td class="text-center"><?= $n->nilai3; ?></td>
                            <td class="text-center"><?=($n->nilai3 != '') ? $grade->getGradeByScore($n->nilai3)->grade : ""; ?></td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center"><?= $n->eskul4; ?></td>
                            <td class="text-center"><?= $n->nilai4; ?></td>
                            <td class="text-center"><?=($n->nilai4 != '') ? $grade->getGradeByScore($n->nilai4)->grade : ""; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-5 mb-3 mt-3"><h5>D. Ketidakhadiran</h5></div>
            <div class="col-12 text-left">
               <table width="50%">
                   <tr><td width="50%">Sakit</td><td></td></tr>
                   <tr><td>Izin</td><td></td></tr>
                   <tr><td>Tanpa Keterangan</td><td></td></tr>
               </table>
            </div>
            <div class="col-12 mt-8 text-center"><p>Acknowledge By</p></div>
            <div class="col-4 mt-2 text-left">
                <p class="text-center"><br>Parents</p>
                <p class="mt-8 text-center"><b>(_________________)</b></p>
            </div>
            <div class="col-4 mt-2">
            </div>
            <div class="col-4 mt-2 text-right">
                <p class="text-center"><?= $dr->kota_terbit;  ?>,&nbsp; <?= date('d F Y', strtotime($dr->tgl_terbit))?> <br>Homeroom Teacher</p>
                <p class="mt-8 text-center"><b><?= $dr->username; ?></b></p>
            </div>
            <div class="col-12 mt-2 text-center">
                <p class="text-center">Principal</p>
                <p class="mt-8 text-center"><b><?= $dr->nm_kepsek; ?></b></p>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
window.print();
window.onafterprint = function () {  window.close(); }
</script>