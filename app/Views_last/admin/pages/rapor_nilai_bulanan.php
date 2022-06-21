<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIM-IHBS | Monthly Report</title>
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/adminlte.min.css">
    <style>
       
        @media print {
            body{color: #000;}
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
                margin-top: 5px;
                margin-bottom: 5px;
                margin-left: 40px;
                font-size: 30px;
            }
            .address{
                margin-top: 10px;
                font-size: 20px;
                margin-left: 40px;
                font-size: 16px;
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
                padding-top: 50px;
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
                font-size: 18px;
            }
            .score th{
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                font-size: 21px;
                text-align: center;
            }
            .profil td{
                font-size: 18px;
                font-weight: 600;
            }
        }
        #print_area .logo-rapor{
            width: 19%;
            float: left;
            padding-left: 20px;
            padding-top: 10px;
        }
        hr{
            height: 2px;
            margin: 2px;
        }
        body{width: 50%; margin: auto; left: 50%; right: 50%; height: 500px;}
        .mt-8{margin-top: 120px;}
    </style>
</head>
<body>
    <div class="modal-body" id="print_area"> 
        <img class="logo-rapor" src="<?= base_url('assets/img/favicon.png')?>">
        <h1 class="text-center title">YAYASAN DAKWAH ISLAM CAHAYA ILMU<br>SMP IBNU HAJAR BOARDING SCHOOL</h1>
        <p class="text-center address">Jl. Musholla Fathul Ulum No. 11 RT. 03 RW. 02 Munjul, Cipayung, Jakarta Timur<br>Telp./Fax: ( 021) 843122779  Website: http://ihbs.sch.id | E-mail: smp.ihbsjakarta@gmail.com</p>
        <hr><hr>
        <h3 class="text-center">كشف الدرجات</h3>
        <h4 class="text-center">STUDENT ACHIEVEMENT REPORT <br><?=date('F  Y',strtotime( $_GET['month']))?></h4>
        <div class="profil">
            <?php 
                $ta = new App\Models\ThnAkademikModel;  
                $pesdik = new App\Models\PesdikModel; 
                $rombel = new App\Models\RombelModel;
                $mapel = new App\Models\MapelModel;
                $nilai = new App\Models\NilaiBulananModel;
                $kkm = new App\Models\GradeModel;
                $dataRapor = new App\Models\RaporBulananModel();
            ?>
            <?php
            $ta = $ta->getDataThnAkademikById($_GET['ta']); 
            $pesdik = $pesdik->getDataPesdikById($_GET['id'])->getRow();
            $rombel = $rombel->getDataRombelById($_GET['rombel'])->getRow();
            $mapel = $mapel->getDataMapelByKls($_GET['kls']);
            $kkm = $kkm->getKkm(session()->get('unit'));
            ?>
            <table width='100%' class="table">
                <tr>
                    <td>Name | الاسم</td>
                    <td width='2px'>:</td>
                    <td><?=$pesdik->nm_pesdik?></td>
                    <td width='5%'></td>
                    <td>Academic Year | العام الدراسي</td>
                    <td width='2px'>:</td>
                    <td><?=$ta->thn_akademik?></td>
                </tr>
                <tr>
                    <td>Class | الصف</td>
                    <td width='2px'>:</td>
                    <td><?=$rombel->nm_rombel?></td>
                    <td width='5%'></td>
                    <td>Semester | الفصل</td>
                    <td width='2px'>:</td>
                    <td><?=$ta->semester?></td>
                </tr>
                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            </table>
        </div>
        <div  class="row score">
            <div class="col-12 mb-3"><h2 class="text-center">ACADEMIC PROGRESS</h2></div>
            <div class="col-6">
                <table style="border: 1px; width:100%;">
                    <thead>
                        <th><b>NO</b></th>
                        <th><b>SUBJECT</b></th>
                        <th><b>SCORE</b></th>
                        <th><b>SCORE CATEGORY</b></th>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($mapel->getResultArray() AS $m): ?>
                        <?php 
                            if ($m['nm_mapel'] == "Siroh" && $ta->semester == "GANJIL" ) {
                                continue;
                            } 
                        ?>
                        <?php $n = $nilai->getDataNilaiByMapel($m['kd_mapel'],$pesdik->nisn,$_GET['month']); ?>    
                        <?php 
                            if(empty($n->score)){
                                $score = 0;
                            }else{
                                $score = $n->score;
                            }
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++;?></td>
                            <td><?= ($m['nm_mapel_ing'] != '') ? $m['nm_mapel_ing'] : $m['nm_mapel'];?></td>
                            <td class="text-center"><?= $score; ?></td>
                            <td class="text-center"><?= ($score > $kkm->standard) ? 'COMPLETE' : 'INCOMPLETE';?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <?php foreach($mapel->getResultArray() AS $m): ?>
                <?php 
                    if ($m['nm_mapel'] == "Siroh" && $ta->semester == "GANJIL" ) {
                        continue;
                    } 
                ?>
                <?php $n = $nilai->getDataNilaiByMapel($m['kd_mapel'],$pesdik->nisn,$_GET['month']);?> 
                <?php 
                    if(empty($n->score)){
                        $score = 0;
                    }else{
                        $score = $n->score;
                    }
                ?>
                <?php if($score > 90){
                    $color = 'bg-blue';
                }else if($score > 76){
                    $color = 'bg-green';
                }elseif($score == 75){
                    $color = 'bg-yellow';
                }elseif($score < 75){
                    $color = 'bg-red';
                } ?>   
                <div class="progress-group" style="font-size: 16px;">
                <?= ($m['nm_mapel_ing'] != '') ? $m['nm_mapel_ing'] : $m['nm_mapel'];?>
                    <span class="float-right"><b><?= $score; ?></b>/100</span>
                    <div class="progress progress-sm">
                    <div class="progress-bar <?=$color;?>" style="width: <?= $score; ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php $dr = $dataRapor->getDataRapor($_GET['month'],$_GET['ta'],$_GET['rombel']); ?>
            <div class="col-4 mt-5 text-left">
                <p class="text-center"><br>Homeroom Teacher | المشرف   </p>
                <p class="mt-8 text-center"><b><?= $dr->username ?></b></p>
            </div>
            <div class="col-4 mt-5">
            </div>
            <div class="col-4 mt-5 text-right">
                <p class="text-center"><?= $dr->kota_terbit;  ?>,&nbsp; <?= date('d F Y', strtotime($dr->tgl_terbit))?> <br>Principal | مدير المدرسة </p>
                <p class="mt-8 text-center"><b><?= $dr->nm_kepsek; ?></b></p>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
window.print();
window.onafterprint = function () {  window.close(),history.go(-1); }
</script>