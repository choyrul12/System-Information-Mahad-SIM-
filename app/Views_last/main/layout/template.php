<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">
  <title>
    Sistem Informasi Ma'had IHBS
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url() ?>/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url() ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?= base_url() ?>/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url() ?>/assets/css/soft-design-system.css?v=1.0.1" rel="stylesheet" />
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.css">
</head>

<body class="presentation-page">
  <!-- Navbar -->
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-sm-3" href="<?=base_url('home')?>" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom">
              <img src="<?= base_url() ?>/assets/img/logo.png" width="120">
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0" id="navigation">
              <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-5 w-100">
                <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-auto text-center">
                  <a class="btn btn-sm  bg-gradient-primary  btn-round mb-0 me-1 mt-2 mt-md-0" id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false"><?= session()->get('username'); ?></a>
                  <div class="dropdown-menu dropdown-menu-animation dropdown-sm p-3 border-radius-lg mt-0 mt-lg-3 text-center" aria-labelledby="dropdownMenuPages">
                    <div class="d-none d-lg-block">
                      <a class="dropdown-item border-radius-md" onclick="confirmLogout()">
                        <i class="fa fa-sign-out"></i> Sign-Out
                      </a>
                    </div>
                    <div class="d-lg-none">
                      <a class="dropdown-item border-radius-md" onclick="confirmLogout()">
                        <i class="fa fa-sign-out"></i> Sign-Out
                      </a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>

  <?= $this->renderSection('content'); ?>

  <div class="modal fade" id="modal-confirm-logout">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-body">
          <h7>Are you sure want to log out the system?</h7>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal">Cancel</button>
          <a href="/doLogout" type="button" class="btn btn-sm btn-danger">Yes Sure</a>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="<?= base_url() ?>/assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
  <script src="<?= base_url() ?>/assets/js/plugins/countup.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
  <script src="<?= base_url() ?>/assets/js/plugins/rellax.min.js"></script>
  <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
  <script src="<?= base_url() ?>/assets/js/plugins/tilt.min.js"></script>
  <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
  <script src="<?= base_url() ?>/assets/js/plugins/choices.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="<?= base_url() ?>/assets/js/plugins/parallax.min.js"></script>
  <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script> -->
  <script src="<?= base_url() ?>/assets/js/soft-design-system.min.js?v=1.0.1" type="text/javascript"></script>
  <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script>
    $(function(){
      $('#searchMonthlyReport').submit(function (e) {
        e.preventDefault(),
        $.ajax({
          url: "<?= base_url('/Home/searchMonthlyReport') ?>",
          type: "POST",
          data: new FormData(this),
          processData: !1,
          contentType: !1,
          cache: !1,
          async: !1,
          dataType: "JSON",
          success: function (e) {
            switch(e.notif){
              case "Success": 
                $('#searchMonthlyReport')[0].reset()
                window.location.href="<?=base_url()?>/administrator/rapor-nilai-bulanan?id="+e.id+"&ta="+e.kd_ta+"&kls="+e.kls+"&rombel="+e.id_rombel+"&month="+e.bulan+""
                break;
              case "Failed": 
                Toast.fire({
                icon: 'error',
                title: 'Sorry Data Not Available',
              });break;
            }
            
          },
        });
      });

      $('#searchSemesterReport').submit(function (e) {
        e.preventDefault(),
        $.ajax({
          url: "<?= base_url('/Home/searchSemesterReport') ?>",
          type: "POST",
          data: new FormData(this),
          processData: !1,
          contentType: !1,
          cache: !1,
          async: !1,
          dataType: "JSON",
          success: function (e) {
            switch(e.notif){
              case "Success": 
                $('#searchSemesterReport')[0].reset()
                window.location.href="<?=base_url()?>/administrator/rapor-semester?id="+e.id+"&ta="+e.kd_ta+"&kls="+e.kls+"&rombel="+e.id_rombel+""
                break;
              case "Failed": 
                Toast.fire({
                icon: 'error',
                title: 'Sorry Data Not Available',
              });break;
            }
            
          },
        });
      });
    })
    const Toast = Swal.mixin({
      toast: true,
      position: 'center',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: false,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
    
    function confirmLogout(){
      Swal.fire({
        title: 'Are you sure ?',
        text: "You want to exit the system !",
        customClass: 'swal-wide',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#32afa9',
        cancelButtonColor: '#d8345f',
        confirmButtonText: 'Yes, sure!',
      }).then((result) => {
        if (result.value) {
          Toast.fire({
            icon: 'success',
            title: 'Thank you, see you later',
          })
          setTimeout(function(){window.location.href='/doLogout'},2e3)
        }
      })
    }
    
    function selectRombel(param1,param2){
      var id = $('#'+param1).val()
      $.ajax({
        url  : "<?= base_url('Rombel/getDataSelectRombel') ?>",
        type : "POST",
        data : {id:id},
        dataType : "JSON",
        success : function(data) {
          $("#"+param2).empty();
          $("#"+param2).append(
              "<option value=''>Select Rombel Class</option>"
            );
          $.each(data, function(index, value) {
            $("#"+param2).append(
              "<option value='"+value.id_rombel+"'>"+value.nm_rombel+"</option>"
            );
          })
        }
      })
    }
  </script>
</body>

</html>