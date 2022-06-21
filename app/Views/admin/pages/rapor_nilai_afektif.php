<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png"> -->
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/adminlte.min.css">
    <style>
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
                font-size: 16px;
            }
            .score th{
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                font-size: 17px;
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
        $nilai = new App\Models\NilaiAfektifModel;
        $kkm = new App\Models\GradeModel;
        $std = new App\Models\AfektifModel;
        $dataRapor = new App\Models\RaporSemesterModel();
    ?>
    <?php
        $ta = $ta->getDataThnAkademikById($_GET['ta']); 
        $pesdik = $pesdik->getDataPesdikById($_GET['id'])->getRow();
        $rombel = $rombel->getDataRombelById($_GET['rombel'])->getRow();
        $mapel = $mapel->getDataMapelByKls($_GET['kls']);
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
            <div class="col-12 mb-3"><h5>A. Sikap</h5><h5>1. Sikap Spiritual</h5></div>
            <div class="col-12">
                <table style="border: 1px; width:100%;">
                    <thead>
                        <th width='25%'><b>Predikat / Grade</b></th>
                        <th><b>Deskripsi / Description</b></th>
                    </thead>
                    <tbody>
                        <?php $n = $nilai->getDataNilaiAfektifByNisn($pesdik->nisn,$_GET['ta']) ?>
                        <?php $desk = $std->getDeskripsiAfektif("SPIRITUAL",$n->spiritual)?>
                        <td style="padding-top: 50px; padding-bottom:50px;" class="text-center"><b><?=$n->spiritual?></b></td>
                        <td style="padding-top: 50px; padding-bottom:50px;" class="text-center"><b><?= $desk->deskripsi ?></b></td>
                    </tbody>
                </table>
            </div>
            <div class="col-12 mb-3 mt-5"><h5>2. Sikap Sosial</h5></div>
            <div class="col-12">
                <table style="border: 1px; width:100%;">
                    <thead>
                        <th width='25%'><b>Predikat / Grade</b></th>
                        <th><b>Deskripsi / Description</b></th>
                    </thead>
                    <tbody>
                        <?php $n = $nilai->getDataNilaiAfektifByNisn($pesdik->nisn,$_GET['ta']) ?>
                        <?php $desk = $std->getDeskripsiAfektif("SOSIAL",$n->spiritual)?>
                        <td style="padding-top: 50px; padding-bottom:50px;" class="text-center"><b><?=$n->sosial?></b></td>
                        <td style="padding-top: 50px; padding-bottom:50px;" class="text-center"><b><?= $desk->deskripsi ?></b></td>
                    </tbody>
                </table>
            </div>
            <div class="col-12 mt-5 text-left">
               <table width="20%">
                   <tr><td><b>Predikat :</b></td></tr>
                   <tr><td>1. Sangat Baik <br> 2. Baik <br> 3. Cukup</td></tr>
               </table>
            </div>
            
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
window.print();
window.onafterprint = function () {  window.close(); }
</script>