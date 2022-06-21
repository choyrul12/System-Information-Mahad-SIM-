<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIM-IHBS | Monthly Report</title>
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/adminlte.min.css">
    <style>
       
        @media print {
            *{
                font-family: "Times New Roman", Times, serif;
            }
            body{color: #000;}
            #print_area{
                display:block;
            }
            .paper{
                border-style: solid;
                border-color:#515E63;
                /*background:#EEEEEE;*/
                padding:20px;
                margin-bottom:1px;
                min-height: 97vh;
            }
            .text-center{
                text-align: center;
            }
            .text-right{
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
            hr{
                margin: 1px;
                height: 1px;
                border-color:#000;
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
                padding: 6px 4px;
                font-size: 19px;
            }
            .score th{
                border: 1px solid black;
                border-collapse: collapse;
                padding: 12px;
                font-size: 18px;
                text-align: center;
            }
            .profil td{
                font-size: 19px;
                font-weight: 600;
            }
            
            .ttd{
                font-size:18px;
                /* padding-top:100px; */
            }
            
            .subject{
                width:"200px";
            }
            .ttd-kepsek{
                width:280px; top:10px; right:50px; position:absolute; 
            }
            .mt-8{margin-top: 200px;}
            /*body{width: 90%; margin: 0 auto; left: 50%; right: 50%; height: 500px;}*/
        }
        @media only screen and (min-width: 768px) {
            *{
                font-family: "Times New Roman", Times, serif;
            }
            #print_area{
                display:block;
            }
            .paper{
                border-style: solid;
                border-color:#515E63;
                background:#F9F9F9;
                padding:20px;
                margin-bottom:15px;
                min-height:1410px;
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
                font-size: 26px;
            }
            .address {
                margin-top: 5px;
                font-size: 13px;
                margin-left: 40px;
            }

            /*.logo-rapor{*/
            /*    width:555px;*/
            /*    display: list-item;*/
                /* list-style-position: inside; */
            /*    margin-left: 15px;*/
            /*    padding-right: 30px;*/
            /*    position: absolute;*/
            /*}*/
            hr{
                margin: 1px;
                height: 1px;
                border-color:#000;
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
                font-size: 16px;
            }
            .score th{
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
                font-size: 16px;
                text-align: center;
            }
            .profil td{
                font-size: 18px;
                font-weight: 600;
            }
            body{width: 95%; margin: auto; left: 50%; right: 50%; height: 500px;}
            .mt-8{margin-top: 150px;}
            
            hr{
                height: 2px;
                margin: 2px;
            }
            .ttd-kepsek{
                width:210px; top:-10px; right:12px; position:absolute; 
            }
        }
        /*@media only screen and (min-width: 768px) {*/
        /*    body{width: 90%; margin: auto; left: 50%; right: 50%; height: 500px;}*/
        /*    .mt-8{margin-top: 120px;}*/
        /*}*/
        .logo-rapor {
            width: 170px;
            float: left;
            padding-left: 50px;
            /*padding-top: 2px;*/
            display: list-item;
            position: absolute;
        }
    </style>
</head>
<body id="test">
    <?php  
        $dataRapor = new App\Models\RaporBulananModel();
        $dr = $dataRapor->getDataRapor($_GET['month'],$_GET['ta'], $_GET['rombel']);
    ?>
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
    <div class="modal-body" id="print_area"> 
        <div class="paper">
            <img class="logo-rapor" src="<?= base_url('assets/img/favicon.png')?>">
            <h1 class="text-center title">YAYASAN DAKWAH ISLAM CAHAYA ILMU<br><?= $dr->nm_sekolah ?></h1>
            <p class="text-center address"><?= $dr->alamat ?><br>Telp./Fax: ( 021) 843122779 Website: http://ihbs.sch.id | E-mail: smp.ihbsjakarta@gmail.com</p>
            <hr><hr>
            <h3 class="text-center mt-4">كشف الدرجات</h3>
            <?php if ($dr->jenis == "Rapor Bulanan"):?>
            <h4 class="text-center">STUDENT ACHIEVEMENT REPORT <br><?=date('F  Y',strtotime( $_GET['month']))?></h4>
            <?php else: ?>
            <h4 class="text-center">MID TERM TEST REPORT</h4>
            <h4 class="text-center">ACADEMIC YEAR <?=$ta->thn_akademik?></h4>
            <?php endif; ?>
            <div class="profil mt-3">
                
                <table width='100%' class="" style="border:0px;">
                    <tr>
                        <td>Name | الاسم</td>
                        <td width='2px'>:</td>
                        <td><?=$pesdik->nm_pesdik?></td>
                        <td width='15%'></td>
                        <td>Academic Year | العام الدراسي</td>
                        <td width='2px'>:</td>
                        <td><?=$ta->thn_akademik?></td>
                    </tr>
                    <tr>
                        <td>Class | الصف</td>
                        <td width='2px'>:</td>
                        <td><?=$rombel->nm_rombel?></td>
                        <td width='15%'></td>
                        <td>Semester | الفصل</td>
                        <td width='2px'>:</td>
                        <td><?=$ta->semester?></td>
                    </tr>
                    <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                </table>
            </div>
            <div  class="row score">
                <div class="col-12 mb-3"><h4 class="text-center">ACADEMIC PROGRESS</h4></div>
                <div class="col-6">
                    <table style="border: 1px; width:100%;">
                        <thead>
                            <th>NO</th>
                            <th class="subject">SUBJECT</th>
                            <th>SCORE</th>
                            <th>SCORE CATEGORY</th>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($mapel->getResultArray() AS $m): ?>
                            <?php 
                                // if ($m['nm_mapel'] == "Siroh" && $ta->semester == "GANJIL" ) {
                                //     continue;
                                // } 
                                if ($m['rapor_bulanan'] == "Hide") {
                                    continue;
                                } 
                            ?>
                            <?php $n = $nilai->getDataNilaiByMapel($m['kd_mapel'],$pesdik->nisn,$_GET['month']); ?>    
                            <?php 
                                if(empty($n->score)){
                                    $score = 0;
                                }else{
                                    $score = round($n->score + 0);
                                }
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++;?></td>
                                <td><?= ($m['nm_mapel_ing'] != '') ? $m['nm_mapel_ing'] : $m['nm_mapel'];?></td>
                                <td class="text-center" style="color:<?= ($score < $kkm->standard) ? '#B61919;' : '#000;'; ?>"><?= $score; ?></td>
                                <td class="text-left"><?= ($score >= $kkm->standard) ? 'Complete | ناجح' : 'Incomplete |  غير مك';?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <?php foreach($mapel->getResultArray() AS $m): ?>
                    <?php 
                        // if ($m['nm_mapel'] == "Siroh" && $ta->semester == "GANJIL" ) {
                        //             continue;
                        // } 
                        if ($m['rapor_bulanan'] == "Hide") {
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
                    }else if($score >= 76){
                        $color = 'bg-green';
                    }elseif($score == 75){
                        $color = 'bg-yellow';
                    }elseif($score < 75){
                        $color = 'bg-red';
                    } ?>   
                    <div class="progress-group" style="font-size: 15px;">
                    <?= ($m['nm_mapel_ing'] != '') ? $m['nm_mapel_ing'] : $m['nm_mapel'];?>
                        <span class="float-right"><b><?= $score; ?></b>/100</span>
                        <div class="progress progress-sm">
                        <div class="progress-bar <?=$color;?>" style="width: <?= $score; ?>%"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php $dr = $dataRapor->getDataRapor($_GET['month'],$_GET['ta'],$_GET['rombel']); ?>
                <div class="col-4 mt-5 text-left ttd">
                    <p class="text-center"><br>Parent | الوالد   </p>
                    <p class="mt-8 text-center"><b>( _______________ )</b></p>
                </div>
                <div class="col-4 mt-5 text-left ttd">
                    <p class="text-center"><br>Homeroom Teacher | المشرف   </p>
                    <p class="mt-8 text-center"><b><?= $dr->username ?></b></p>
                </div>
                <div class="col-4 mt-5 text-center ttd">
                    <p class="text-center" style="position:relative;"><?= $dr->kota_terbit;  ?>,&nbsp; <?= date('d F Y', strtotime($dr->tgl_terbit))?> <br>Principal | مدير المدرسة </p>
                    <img class="ttd-kepsek" src="<?= base_url('assets/images/ttd/ttd-kepsek.png')?>">
                    <p class="text-center  mt-8" style="position:relative;"><b><?= $dr->nm_kepsek; ?></b></p>
                </div>
            </div> 
        </div>
    </div>
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
      window.onafterprint = function () {  window.close(),history.go(-1); }
    }
    // return false;
//   });
});
</script>