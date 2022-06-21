<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>/assets/img/apple-icon.png">

  <link rel="icon" type="image/png" href="<?= base_url() ?>/assets/img/favicon.png">

  <title>SIM-IHBS | <?= $title; ?></title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Tempusdominus Bbootstrap 4 -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- iCheck -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- JQVMap -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/jqvmap/jqvmap.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/adminlte.min.css">

  <!-- overlayScrollbars -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Daterange picker -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/daterangepicker/daterangepicker.css">

  <!-- summernote -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.css">

  <!-- Google Font: Source Sans Pro -->

  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- SweetAlert2 -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.css">

  <!-- Datatables -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- Select2 -->

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/select2/css/select2.min.css">

  <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <style>
    @media print {

      .text-center {

        text-align: center;

      }

    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">



    <!-- Navbar -->

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <ul class="navbar-nav">

        <li class="nav-item">

          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

        </li>

      </ul>

      <!-- Right navbar links -->

      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">

          <a class="nav-link" data-toggle="dropdown" href="#">

            <img src="<?= base_url() ?>/assets/images/avatar.png" alt="User Avatar" class="img-size-50 mr-1 img-circle" style="width:30px;">

            <?= session()->get('username'); ?>

          </a>

          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">

            <a href="#" class="dropdown-item" onclick="confirmLogout()">

              <i class="fas fa-sign-out-alt mr-2"></i> Logout

              <span class="float-right text-muted text-sm">-</span>

            </a>

          </div>

        </li>

        <!-- <li class="nav-item">

        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">

          <i class="fas fa-th-large"></i>

        </a>

      </li> -->

      </ul>

    </nav>

    <!-- /.navbar -->



    <!-- Main Sidebar Container -->

    <aside class="main-sidebar sidebar-dark-secondary elevation-4">

      <!-- Brand Logo -->

      <!-- <a href="index3.html" class="brand-link">

      <img src="<?= base_url() ?>/assets/images/logo.png" alt="IHBS Logo" class="brand-image img-circle elevation-3"

           style="opacity: .8">

      <span class="brand-text font-weight-light">Sistem_Informasi Mahad</span>

    </a> -->



      <!-- Sidebar -->

      <div class="sidebar">

        <!-- Sidebar user panel (optional) -->

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

          <div class="image">

            <img src="<?= base_url() ?>/assets/img/favicon.png" class="img-circle elevation-2" alt="Logo IHBS">

          </div>

          <div class="info">

            <a href="#" class="d-block">Sistem Informasi Ma'had</a>

          </div>

        </div>



        <!-- Sidebar Menu -->

        <nav class="mt-2">

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-header"><b><?= $menu_name ?></b></li>

            <?php

            use CodeIgniter\Session\Session;

            foreach ($menu_list as $m) : ?>

              <li class="nav-item">

                <?php $request = \Config\Services::request(); ?>

                <a href="<?= $m['link'] ?>" class="nav-link <?= ($request->uri->getSegment(2) == $m['id']) ? 'active' : ''; ?>">

                  <i class="<?= $m['icon'] ?>"></i>

                  <p><?= $m['title'] ?></p>

                </a>

                <?php foreach ($menu_tree as $t) : ?>

                  <?php if ($t['parent'] == $m['id']) : ?>

                    <ul class="nav nav-treeview">

                      <li class="nav-item">

                        <a href="<?= $t['link'] ?>" class="nav-link <?= ($request->uri->getSegment(2) == $m['id']) ? 'active' : ''; ?>">

                          &nbsp;&nbsp;&nbsp;<i class="<?= $t['icon'] ?>"></i>

                          <p><?= $t['title'] ?></p>

                        </a>

                      </li>

                    </ul>

                  <?php endif; ?>

                <?php endforeach; ?>

              </li>

            <?php endforeach; ?>

          </ul>

        </nav>

        <!-- /.sidebar-menu -->

      </div>

      <!-- /.sidebar -->

    </aside>



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <section class="content-header">

        <div class="container-fluid">

          <div class="row mb-2">

            <div class="col-sm-6">

              <h1><?= $title; ?></h1>

            </div>

            <div class="col-sm-6">

              <ol class="breadcrumb float-sm-right">

                <li class="breadcrumb-item"><a href="#">Home</a></li>

                <li class="breadcrumb-item active"><?= $title; ?></li>

              </ol>

            </div>

          </div>

        </div><!-- /.container-fluid -->

      </section>

      <?= $this->renderSection('content'); ?>

    </div>

    <!-- /.content-wrapper -->

    <footer class="main-footer">

      <strong>Copyright &copy; 2021 - IHBS.</strong>

      All rights reserved.

      <div class="float-right d-none d-sm-inline-block">

        <b>Version</b> 1.0.1

      </div>

    </footer>



    <div class="modal fade" id="modal-confirm-logout">

      <div class="modal-dialog modal-sm">

        <div class="modal-content">

          <div class="modal-body">

            <h6>Anda yakin akan keluar dari sistem &hellip;?</h6>

          </div>

          <div class="modal-footer justify-content-between">

            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>

            <a href="/doLogout" type="button" class="btn btn-sm btn-danger">Yes Sure</a>

          </div>

        </div>

      </div>

    </div>



    <!-- Control Sidebar -->

    <aside class="control-sidebar control-sidebar-dark">

      <!-- Control sidebar content goes here -->

    </aside>

    <!-- /.control-sidebar -->

  </div>

  <!-- ./wrapper -->



  <!-- jQuery -->

  <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>

  <!-- jQuery UI 1.11.4 -->

  <script src="<?= base_url() ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

  <!-- Bootstrap 4 -->

  <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- ChartJS -->

  <script src="<?= base_url() ?>/assets/plugins/chart.js/Chart.min.js"></script>

  <!-- Sparkline -->

  <script src="<?= base_url() ?>/assets/plugins/sparklines/sparkline.js"></script>

  <!-- JQVMap -->

  <script src="<?= base_url() ?>/assets/plugins/jqvmap/jquery.vmap.min.js"></script>

  <script src="<?= base_url() ?>/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

  <!-- jQuery Knob Chart -->

  <script src="<?= base_url() ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>

  <!-- daterangepicker -->

  <script src="<?= base_url() ?>/assets/plugins/moment/moment.min.js"></script>

  <script src="<?= base_url() ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>

  <!-- Tempusdominus Bootstrap 4 -->

  <script src="<?= base_url() ?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Summernote -->

  <script src="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>

  <!-- overlayScrollbars -->

  <script src="<?= base_url() ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

  <!-- AdminLTE App -->

  <script src="<?= base_url() ?>/assets/js/adminlte.js"></script>

  <script src="<?= base_url() ?>/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

  <!-- SweetAlert2 -->

  <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- Datatables -->

  <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>

  <script src="<?= base_url() ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

  <script src="<?= base_url() ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

  <script src="<?= base_url() ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- Select2 -->

  <script src="<?= base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>

  <script type="text/javascript" src="https://unpkg.com/xlsx@0.17.0/dist/xlsx.full.min.js"></script>



  <script>
    $(function() {

      $.ajax({

        type: "POST",

        url: "/RekamMedis/getGrafikRekamMedis",

        dataType: "JSON",

        success: function(data) {

          console.log(data);

          var label = [];

          var value = [];

          for (var i in data) {

            label.push(data[i].tgl);

            value.push(data[i].jml);

          }

          'use strict'

          var ticksStyle = {

            fontColor: '#495057',

            fontStyle: 'bold'

          }

          var mode = 'index'

          var intersect = true

          var $visitorsChart = $('#visitors-chart')

          var visitorsChart = new Chart($visitorsChart, {

            data: {

              labels: label,

              datasets: [{

                type: 'line',

                data: value,

                backgroundColor: 'transparent',

                borderColor: '#007bff',

                pointBorderColor: '#007bff',

                pointBackgroundColor: '#007bff',

                fill: false

              }]

            },

            options: {

              maintainAspectRatio: false,

              tooltips: {

                mode: mode,

                intersect: intersect

              },

              hover: {

                mode: mode,

                intersect: intersect

              },

              legend: {

                display: false

              },

              scales: {

                yAxes: [{

                  // display: false,

                  gridLines: {

                    display: true,

                    lineWidth: '4px',

                    color: 'rgba(0, 0, 0, .2)',

                    zeroLineColor: 'transparent'

                  },

                  ticks: $.extend({

                    beginAtZero: true,

                    suggestedMax: 50

                  }, ticksStyle)

                }],

                xAxes: [{

                  display: true,

                  gridLines: {

                    display: false

                  },

                  ticks: ticksStyle

                }]

              }

            }

          })

        }

      })



      $('.select2bs4').select2({

        theme: 'bootstrap4'

      })



      $("#list_pesdik").select2({

        theme: 'bootstrap4',

        ajax: {

          url: "/pesdik/getSelectPesdik",

          type: "post",

          dataType: 'json',

          delay: 250,

          data: function(params) {

            var query = {

              search: params.term,

              type: 'public'

            }

            return query

          },

          processResults: function(response) {

            return {

              results: response

            };

          },

          cache: true

        }

      });

      $("#excelexportrekammedis").click(function() {

        // function ExportToExcel(type, fn, dl) {

        var fn = ''

        var dl = ''

        var type = 'xlsx'

        var elt = document.getElementById('tbDataRekamMedis_wrapper');

        var wb = XLSX.utils.table_to_book(elt, {
          sheet: "Sheet JS"
        });

        return dl ?

          XLSX.write(wb, {
            bookType: type,
            bookSST: true,
            type: 'base64'
          }) :

          XLSX.writeFile(wb, fn || ('rekam_medis.' + (type || 'xlsx')));

        // }

      });


      $("#excelexportnilai").click(function() {

        // function ExportToExcel(type, fn, dl) {

        var fn = ''

        var dl = ''

        var type = 'xlsx'

        var elt = document.getElementById('tbDataNilaiMapel_wrapper');

        var wb = XLSX.utils.table_to_book(elt, {
          sheet: "Sheet JS"
        });

        return dl ?

          XLSX.write(wb, {
            bookType: type,
            bookSST: true,
            type: 'base64'
          }) :

          XLSX.writeFile(wb, fn || ('format_nilai.' + (type || 'xlsx')));

        // }

      });

      $("#excelexporteskul").click(function() {

        // function ExportToExcel(type, fn, dl) {

        var fn = ''

        var dl = ''

        var type = 'xlsx'

        var elt = document.getElementById('tbDataNilaiEskul_wrapper');

        var wb = XLSX.utils.table_to_book(elt, {
          sheet: "Sheet JS"
        });

        return dl ?

          XLSX.write(wb, {
            bookType: type,
            bookSST: true,
            type: 'base64'
          }) :

          XLSX.writeFile(wb, fn || ('format_nilai.' + (type || 'xlsx')));

        // }

      });

      $("#excelexportabsensi").click(function() {

        // function ExportToExcel(type, fn, dl) {

        var fn = ''

        var dl = ''

        var type = 'xlsx'

        var elt = document.getElementById('tbDataAbsensi_wrapper');

        var wb = XLSX.utils.table_to_book(elt, {
          sheet: "Sheet JS"
        });

        return dl ?

          XLSX.write(wb, {
            bookType: type,
            bookSST: true,
            type: 'base64'
          }) :

          XLSX.writeFile(wb, fn || ('format_absensi.' + (type || 'xlsx')));

        // }

      });



      $("#excelnilaibulan").click(function() {

        var fn = ''

        var dl = ''

        var type = 'xlsx'

        var elt = document.getElementById('tbDataNilaiBulanan_wrapper');

        var wb = XLSX.utils.table_to_book(elt, {
          sheet: "Sheet JS"
        });

        return dl ?

          XLSX.write(wb, {
            bookType: type,
            bookSST: true,
            type: 'base64'
          }) :

          XLSX.writeFile(wb, fn || ('format_nilai.' + (type || 'xlsx')));

      });



      $("#check-all").click(function() { // Ketika user men-cek checkbox all

        if ($(this).is(":checked")) // Jika checkbox all diceklis

          $(".custom-control-input").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"

        else // Jika checkbox all tidak diceklis

          $(".custom-control-input").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"

      });

      $('#lulusPesdik').submit(function(e) {

        var url = $("#url").val()

        var tb = $("#tb").val()

        e.preventDefault(),

          Swal.fire({

            title: 'Are you sure ?',

            text: "Change student status to graduate",

            customClass: 'swal-wide',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#32afa9',

            cancelButtonColor: '#d8345f',

            confirmButtonText: 'Yes, sure!',

          }).then((result) => {

            if (result.value) {

              $.ajax({

                url: url,

                type: "POST",

                data: new FormData(this),

                processData: !1,

                contentType: !1,

                cache: !1,

                async: !1,

                dataType: "JSON",

                success: function(e) {

                  switch (e[0]) {

                    case "Success Update":

                      eval(tb)

                      Toast.fire({

                        icon: 'success',

                        title: 'Update Data Success',

                      });
                      break;

                    case "Failed Update":

                      Toast.fire({

                        icon: 'error',

                        title: 'Update Data Failed',

                      });
                      break;

                  }

                },

              });

            }

          })

      });

      $('#deleteNilai').submit(function(e) {

        var url = $("#url").val()

        var tb = $("#tb").val()

        e.preventDefault(),

          Swal.fire({

            title: 'Are you sure ?',

            text: "You want to delete selected data",

            customClass: 'swal-wide',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#32afa9',

            cancelButtonColor: '#d8345f',

            confirmButtonText: 'Yes, sure!',

          }).then((result) => {

            if (result.value) {

              $.ajax({

                url: url,

                type: "POST",

                data: new FormData(this),

                processData: !1,

                contentType: !1,

                cache: !1,

                async: !1,

                dataType: "JSON",

                success: function(e) {

                  switch (e[0]) {

                    case "Success Delete":

                      eval(tb)

                      Toast.fire({

                        icon: 'success',

                        title: 'Delete Data Success',

                      });
                      break;

                    case "Failed Delete":

                      Toast.fire({

                        icon: 'error',

                        title: 'Delete Data Failed',

                      });
                      break;

                  }

                },

              });

            }

          })

      });


      $('#deleteAbsensi').submit(function(e) {
        var url = $("#url").val()

        var tb = $("#tb").val()

        e.preventDefault(),

          Swal.fire({

            title: 'Are you sure ?',

            text: "You want to delete selected data",

            customClass: 'swal-wide',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#32afa9',

            cancelButtonColor: '#d8345f',

            confirmButtonText: 'Yes, sure!',

          }).then((result) => {

            if (result.value) {

              $.ajax({

                url: url,

                type: "POST",

                data: new FormData(this),

                processData: !1,

                contentType: !1,

                cache: !1,

                async: !1,

                dataType: "JSON",

                success: function(e) {

                  switch (e[0]) {

                    case "Success Delete":

                      eval(tb)

                      Toast.fire({

                        icon: 'success',

                        title: 'Delete Data Success',

                      });
                      break;

                    case "Failed Delete":

                      Toast.fire({

                        icon: 'error',

                        title: 'Delete Data Failed',

                      });
                      break;

                  }

                },

              });

            }

          })

      });


      $('#nilaiAfektif').submit(function(e) {

        var formData = new FormData(this)

        var ta = $("#ta").val()

        formData.append('ta', ta);

        e.preventDefault(),

          $.ajax({

            url: "<?= base_url('/NilaiAfektif/insertDataNilaiAfektif') ?>",

            type: "POST",

            data: formData,

            processData: !1,

            contentType: !1,

            cache: !1,

            async: !1,

            dataType: "JSON",

            success: function(e) {

              switch (e[0]) {

                case "Success Input":

                  tbDataNilaiAfektif()

                  Toast.fire({

                    icon: 'success',

                    title: 'Input Data Success',

                  });
                  break;

                case "Failed Input":

                  Toast.fire({

                    icon: 'error',

                    title: 'Input Data Failed',

                  });
                  break;

              }

            },

          });

      });



      $('#Absensi').submit(function(e) {

        var formData = new FormData(this)

        var ta = $("#ta").val()

        formData.append('ta', ta);

        e.preventDefault(),

          $.ajax({

            url: "<?= base_url('/Absensi/insertDataAbsensi') ?>",

            type: "POST",

            data: formData,

            processData: !1,

            contentType: !1,

            cache: !1,

            async: !1,

            dataType: "JSON",

            success: function(e) {

              switch (e[0]) {

                case "Success Input":

                  tbDataAbsensi()

                  Toast.fire({

                    icon: 'success',

                    title: 'Input Data Success',

                  });
                  break;

                case "Failed Input":

                  Toast.fire({

                    icon: 'error',

                    title: 'Input Data Failed',

                  });
                  break;

              }

            },

          });

      });



      $('#nilaiEskul').submit(function(e) {

        var formData = new FormData(this)

        var ta = $("#ta").val()

        formData.append('ta', ta);

        e.preventDefault(),

          $.ajax({

            url: "<?= base_url('/NilaiEskul/insertDataNilaiEskul') ?>",

            type: "POST",

            data: formData,

            processData: !1,

            contentType: !1,

            cache: !1,

            async: !1,

            dataType: "JSON",

            success: function(e) {

              switch (e[0]) {

                case "Success Input":

                  tbDataNilaiEskul()

                  Toast.fire({

                    icon: 'success',

                    title: 'Input Data Success',

                  });
                  break;

                case "Failed Input":

                  Toast.fire({

                    icon: 'error',

                    title: 'Input Data Failed',

                  });
                  break;

              }

            },

          });

      });



      bsCustomFileInput.init();

      var form = [];

      $("form[id^='form_']").each(function() {
        form.push(this.id);
      });

      $(form).each(function(key, value) {

        $('#' + value).submit(function(e) {

          var action = $('#' + value).find('input[id="action"]').val()

          var tb = $('#' + value).find('input[id="table"]').val()

          e.preventDefault(),

            $.ajax({

              url: action,

              type: "POST",

              data: new FormData(this),

              processData: !1,

              contentType: !1,

              cache: !1,

              async: !1,

              dataType: "JSON",

              success: function(e) {

                switch (e[0]) {

                  case "Empty":

                    $(":input").removeClass("is-invalid")

                    $.each(e, function(key, value) {

                      $("#" + key).addClass("is-invalid")

                      $("input[name=" + key + "]").addClass("is-invalid")

                      $("textarea[name=" + key + "]").addClass("is-invalid")

                      $("select[name=" + key + "]").addClass("is-invalid")

                      $("#" + key + "-feedback").text(value)

                    });

                    break;

                  case "Success Input":

                    eval(tb)

                    $(":input").removeClass("is-invalid")

                    $('.select2').val(null).trigger('change')

                    // $('form')[0].reset()

                    Toast.fire({

                      icon: 'success',

                      title: 'Input Data Success',

                    });
                    break;

                  case "Failed Input":

                    Toast.fire({

                      icon: 'error',

                      title: 'Input Data Failed',

                    });
                    break;

                  case "Success Update":

                    $('.select2').val(null).trigger('change')

                    $('#form-input').hide();

                    eval(tb)

                    $('.modal').modal('hide')

                    $(":input").removeClass("is-invalid")

                    // $('form')[0].reset()

                    Toast.fire({

                      icon: 'success',

                      title: 'Update Data Success',

                    });
                    break;

                  case "Failed Update":

                    Toast.fire({

                      icon: 'error',

                      title: 'Update Data Failed',

                    });
                    break;

                }

              },

            });

        });

      })



    });



    const Toast = Swal.mixin({

      toast: true,

      position: 'top',

      showConfirmButton: false,

      timer: 3000,

      timerProgressBar: false,

      didOpen: (toast) => {

        toast.addEventListener('mouseenter', Swal.stopTimer)

        toast.addEventListener('mouseleave', Swal.resumeTimer)

      }

    })



    function confirmLogout() {

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

          setTimeout(function() {
            window.location.href = '/doLogout'
          }, 2e3)

        }
      })

    }



    function confirmDelete(url, id, nm, tb) {

      Swal.fire({

        title: 'Are you sure ?',

        text: "You want to delete ( " + decodeURI(nm) + " ) !",

        customClass: 'swal-wide',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#32afa9',

        cancelButtonColor: '#d8345f',

        confirmButtonText: 'Yes, sure!',

      }).then((result) => {

        if (result.value) {

          $.ajax({

            type: "POST",

            url: url,

            data: {
              id: id
            },

            dataType: "JSON",

            success: function(e) {

              switch (e[0]) {

                case "Success Delete":

                  eval(tb)

                  Toast.fire({

                    icon: 'success',

                    title: 'Delete Data Success',

                  });
                  break;

                case "Failed Delete":

                  Toast.fire({

                    icon: 'error',

                    title: 'Delete Data Failed',

                  });
                  break;

              }

            }

          })

        }

      })

    }



    function editData(url, id) {

      $.ajax({

        url: url,

        type: "POST",

        data: {
          id: id
        },

        dataType: "JSON",

        success: function(e) {

          $("#btn-submit").text('UPDATE DATA');

          $("#key").val(id)

          $('#form-input').show();

          $.each(e, function(key, value) {

            $("input[name=" + key + "]").val(value)

            $("select[name=" + key + "]").val(value)

            $("textarea[name=" + key + "]").val(value)

            // $('#'+key).val(value).trigger('change')

            // $('#'+key).val(value).select2().trigger('change');

          });

        }

      });

    }



    tbDataPesdik()

    function tbDataPesdik() {

      $('#tbDataPesdik').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        lengthMenu: [100, 200, 500, 600],

        ajax: {

          url: '<?= base_url("/pesdik/getDataPesdik") ?>',

          // type: 'POST'

        },

        columns: [

          {
            data: 'id_pesdik',
            name: 'id_pesdik'
          },

          {
            data: 'nisn',
            name: 'nisn'
          },

          {
            data: 'nipd',
            name: 'nipd'
          },

          {
            data: 'nm_pesdik',
            name: 'tb_pesdik.nm_pesdik'
          },

          {
            data: 'romawi',
            name: 'romawi'
          },

          {
            data: 'rombel',
            name: 'tb_pesdik.rombel'
          },

          {
            data: 'rombel',
            name: 'rombel',
            visible: <?= (session()->get('level') < 3) ? 'true' : 'false'; ?>
          },

        ],



        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' name='nisn[]' type='checkbox' id='customCheckbox[" + no + "]' value='" + data["nisn"] + "'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(1).html("<a href='/administrator/data-pesdik/" + data["id_pesdik"] + "' class='btn btn-info btn-sm mr-2' title='Detail Profile'>" + data["nisn"] + "</a>");

          $('td', row).eq(6).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/pesdik/getDataPesdikById','" + data["id_pesdik"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/pesdik/deleteDataPesdik','" + data["id_pesdik"] + "','" + encodeURI(data["nm_pesdik"]) + "','tbDataPesdik()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    tbDataRekamMedis(m = "")

    function tbDataRekamMedis(m) {

      if (!m) {

        var m = $('#bulan_rekam_medis').val()

      }

      $('#tbDataRekamMedis').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        lengthMenu: [100, 200, 500, 600],
        paging: true,
        searching: {
          "regex": true
        },

        ajax: {

          url: '<?= base_url("/RekamMedis/getDataRekamMedis") ?>',

          // type: 'POST',

          data: {
            m: m
          }

        },

        columns: [

          {
            data: 'id_rekam_medis',
            name: 'id_rekam_medis'
          },


          {
            data: 'tgl_periksa',
            name: 'tgl_periksa'
          },

          {
            data: 'nm_pesdik',
            name: 'nm_pesdik'
          },

          {
            data: 'rombel',
            name: 'rombel'
          },
          {
            data: 'anamnesa',
            name: 'anamnesa'
          },

          {
            data: 'diagnosis',
            name: 'diagnosis'
          },

          {
            data: 'penyakit_dahulu',
            name: 'penyakit_dahulu'
          },

          {
            data: 'pemeriksaan_fisik',
            name: 'pemeriksaan_fisik'
          },

          {
            data: 'riwayat_keluarga',
            name: 'riwayat_keluarga'
          },

          {
            data: 'alergi',
            name: 'alergi'
          },

          {
            data: 'penanganan',
            name: 'penanganan'
          },

          {
            data: 'obat',
            name: 'obat'
          },

          {
            data: 'note',
            name: 'note'
          },

          {
            data: 'status',
            name: 'status'
          },

          {
            data: 'petugas',
            name: 'petugas'
          },

          {
            data: 'id_rekam_medis',
            name: 'id_rekam_medis'
          },

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");
          $('td', row).eq(15).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/RekamMedis/getDataRekamMedisById','" + data["id_rekam_medis"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/RekamMedis/deleteDataRekamMedis','" + data["id_rekam_medis"] + "','" + encodeURI(data["nm_pesdik"]) + "','tbDataRekamMedis()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    tbDataStokObat()

    function tbDataStokObat() {

      $('#tbDataStokObat').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/StokObat/getDataStokObat") ?>'

        },

        columns: [

          {
            data: 'id_obat',
            name: 'id_obat'
          },

          {
            data: 'nm_obat',
            name: 'nm_obat'
          },

          {
            data: 'jenis',
            name: 'jenis'
          },

          {
            data: 'stok',
            name: 'stok'
          },

          {
            data: 'satuan',
            name: 'satuan'
          },

          {
            data: 'last_update',
            name: 'last_update'
          },

          {
            data: 'id_obat',
            name: 'id_obat'
          },

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(6).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/StokObat/getDataStokObatById','" + data["id_obat"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/StokObat/deleteDataStokObat','" + data["id_obat"] + "','" + encodeURI(data["nm_obat"]) + "','tbDataStokObat()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    $("#bulan_rekam_medis").change(function() {

      var m = $("#bulan_rekam_medis").val();

      tbDataRekamMedis(m)

    });



    tbDataRombel()

    function tbDataRombel() {

      $('#tbDataRombel').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/Rombel/getDataRombel") ?>'

        },

        columns: [

          {
            data: 'id_rombel',
            name: 'id_rombel'
          },

          {
            data: 'romawi',
            name: 'romawi'
          },

          {
            data: 'nm_rombel',
            name: 'nm_rombel'
          },

          {
            data: 'id_rombel',
            name: 'id_rombel'
          },

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(3).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/Rombel/getDataRombelById','" + data["id_rombel"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/Rombel/deleteDataRombel','" + data["id_rombel"] + "','" + encodeURI(data["nm_rombel"]) + "','tbDataRombel()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    function selectRombel(param1, param2) {

      var id = $('#' + param1).val()

      $.ajax({

        url: "<?= base_url('Rombel/getDataSelectRombel') ?>",

        type: "POST",

        data: {
          id: id
        },

        dataType: "JSON",

        success: function(data) {

          $("#" + param2).empty();

          $("#" + param2).append(

            "<option value=''>Select Rombel</option>"

          );

          $.each(data, function(index, value) {

            $("#" + param2).append(

              "<option value='" + value.id_rombel + "'>" + value.nm_rombel + "</option>"

            );

          })

        }

      })

    }



    function getMapelByKls() {

      var id = $('#kelas').val()

      $.ajax({

        url: "<?= base_url('Mapel/getDataMapelByKls') ?>",

        type: "POST",

        data: {
          id: id
        },

        dataType: "JSON",

        success: function(data) {

          $("#mapel").empty();

          $("#mapel").append(

            "<option value=''>Select Mapel</option>"

          );

          $.each(data, function(index, value) {

            $("#mapel").append(

              "<option value='" + value.kd_mapel + "'>" + value.nm_mapel + "</option>"

            );

          })

        }

      })

    }



    tbDataMapel()

    function tbDataMapel() {

      $('#tbDataMapel').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/Mapel/getDataMapel") ?>'

        },

        columns: [

          {
            data: 'kd_mapel',
            name: 'kd_mapel'
          },

          {
            data: 'nm_mapel',
            name: 'nm_mapel'
          },

          {
            data: 'nm_mapel_ing',
            name: 'nm_mapel_ing'
          },

          {
            data: 'romawi',
            name: 'romawi'
          },

          {
            data: 'kelompok_mapel',
            name: 'kelompok_mapel'
          },

          {
            data: 'urutan_mapel',
            name: 'urutan_mapel'
          },

          {
            data: 'kd_mapel',
            name: 'kd_mapel'
          },

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(6).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/Mapel/getDataMapelById','" + data["kd_mapel"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/Mapel/deleteDataMapel','" + data["kd_mapel"] + "','" + encodeURI(data["nm_mapel"]) + "','tbDataMapel()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    tbDataGuru()

    function tbDataGuru() {

      $('#tbDataGuru').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/Guru/getDataGuru") ?>'

        },

        columns: [

          {
            data: 'id_guru',
            name: 'id_guru'
          },

          {
            data: 'accesskey',
            name: 'accesskey'
          },

          {
            data: 'username',
            name: 'username'
          },

          {
            data: 'status',
            name: 'status'
          },

          {
            data: 'id_guru',
            name: 'kls_mapel'
          }

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(4).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/Guru/getDataGuruById','" + data["id_guru"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/Guru/deleteDataGuru','" + data["id_guru"] + "','" + encodeURI(data["nm_guru"]) + "','tbDataGuru()') title='Delete'><i class='fa fa-trash'></i></button>");

          if (data["status"] == "Aktif") {

            $('td', row).eq(3).html("<div class='form-group' style='text-align:center'><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' class='custom-control-input' id='customSwitch" + no + 5 + "' checked onchange='changeStatusGuru(" + data["id_guru"] + ")'><label class='custom-control-label' for='customSwitch" + no + 5 + "'></label></div></div>")

          } else {

            $('td', row).eq(3).html("<div class='form-group' style='text-align:center'><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' class='custom-control-input' id='customSwitch" + no + 5 + "' onchange='changeStatusGuru(" + data["id_guru"] + ")'><label class='custom-control-label' for='customSwitch" + no + 5 + "'></label></div></div>")

          }

        }

      });

    }



    function changeStatusGuru(id) {

      $.ajax({

        url: "<?= base_url('guru/changeStatusGuru') ?>",

        type: "POST",

        data: {
          id: id
        },

        dataType: "JSON",

        success: function(e) {

          switch (e[0]) {

            case "Success Update":

              tbDataGuru()

              Toast.fire({

                icon: 'success',

                title: 'Update Data Success',

              });
              break;

            case "Failed Update":

              tbDataGuru()

              Toast.fire({

                icon: 'error',

                title: 'Update Data Failed',

              });
              break;

          }

        }

      })

    }



    tbDataThnAkademik()

    function tbDataThnAkademik() {

      $('#tbDataThnAkademik').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/ThnAkademik/getDataThnAkademik") ?>'

        },

        columns: [

          {
            data: 'kd_ta',
            name: 'kd_ta'
          },

          {
            data: 'kd_ta',
            name: 'kd_ta'
          },

          {
            data: 'thn_akademik',
            name: 'thn_akademik'
          },

          {
            data: 'semester',
            name: 'semester'
          },

          {
            data: 'status',
            name: 'status'
          },

          {
            data: 'kd_ta',
            name: 'kd_ta'
          }

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(5).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/ThnAkademik/getDataThnAkademikById','" + data["kd_ta"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/ThnAkademik/deleteDataThnAkademik','" + data["kd_ta"] + "','" + encodeURI(data["thn_akademik"]) + data["semester"] + "','tbDataThnAkademik()') title='Delete'><i class='fa fa-trash'></i></button>");

          if (data["status"] == "Aktif") {

            $('td', row).eq(4).html("<div class='form-group' style='text-align:center'><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' class='custom-control-input' id='customSwitch" + no + 5 + "' checked onchange=changeStatusThnAkademik('" + encodeURIComponent(data["kd_ta"]) + "')><label class='custom-control-label' for='customSwitch" + no + 5 + "'></label></div></div>")

          } else {

            $('td', row).eq(4).html("<div class='form-group' style='text-align:center'><div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success'><input type='checkbox' class='custom-control-input' id='customSwitch" + no + 5 + "' onchange=changeStatusThnAkademik('" + encodeURIComponent(data["kd_ta"]) + "')><label class='custom-control-label' for='customSwitch" + no + 5 + "'></label></div></div>")

          }

        }

      });

    }



    function changeStatusThnAkademik(id) {

      $.ajax({

        url: "<?= base_url('ThnAkademik/changeStatusThnAkademik') ?>",

        type: "POST",

        data: {
          id: decodeURIComponent(id)
        },

        dataType: "JSON",

        success: function(e) {

          switch (e[0]) {

            case "Success Update":

              tbDataThnAkademik()

              Toast.fire({

                icon: 'success',

                title: 'Update Data Success',

              });
              break;

            case "Failed Update":

              tbDataThnAkademik()

              Toast.fire({

                icon: 'error',

                title: 'Update Data Failed',

              });
              break;

          }

        }

      })

    }



    tbDataGrade()

    function tbDataGrade() {

      $('#tbDataGrade').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/Grade/getDataGrade") ?>'

        },

        columns: [

          {
            data: 'id_grade',
            name: 'id_grade'
          },

          {
            data: 'grade',
            name: 'grade'
          },

          {
            data: 'min',
            name: 'min'
          },

          {
            data: 'max',
            name: 'max'
          },

          {
            data: 'id_grade',
            name: 'id_grade'
          }

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(4).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/Grade/getDataGradeById','" + data["id_grade"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/Grade/deleteDataGrade','" + data["id_grade"] + "','Grade-" + data["grade"] + "','tbDataGrade()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    function editKkm(id) {

      $.ajax({

        url: "<?= base_url('Grade/getKkmById') ?>",

        type: "POST",

        data: {
          id: decodeURIComponent(id)
        },

        dataType: "JSON",

        success: function(e) {

          $('#id_kkm').val(e['id_kkm'])

          $('#standard').val(e['standard'])

        }

      })

    }



    tbDataAfektif()

    function tbDataAfektif() {

      $('#tbDataAfektif').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/Afektif/getDataAfektif") ?>'

        },

        columns: [

          {
            data: 'id_afektif',
            name: 'id_afektif'
          },

          {
            data: 'kategori',
            name: 'kategori'
          },

          {
            data: 'predikat',
            name: 'predikat'
          },

          {
            data: 'deskripsi',
            name: 'deskripsi'
          },

          {
            data: 'id_afektif',
            name: 'id_afektif'
          }

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(4).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/Afektif/getDataAfektifById','" + data["id_afektif"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/Afektif/deleteDataAfektif','" + data["id_afektif"] + "','Grade-" + data["id_afektif"] + "','tbDataAfektif()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    tbDataEskul()

    function tbDataEskul() {

      $('#tbDataEskul').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/Eskul/getDataEskul") ?>'

        },

        columns: [

          {
            data: 'id_eskul',
            name: 'id_eskul'
          },

          {
            data: 'nm_eskul',
            name: 'nm_eskul'
          },

          {
            data: 'id_eskul',
            name: 'id_eskul'
          }

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(2).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/Eskul/getDataEskulById','" + data["id_eskul"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/Eskul/deleteDataEskul','" + data["id_eskul"] + "','" + data["grade"] + "','tbDataEskul()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    tbDataStdEskul()

    function tbDataStdEskul() {

      $('#tbDataStdEskul').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/StdEskul/getDataStdEskul") ?>'

        },

        columns: [

          {
            data: 'id_std_eskul',
            name: 'id_std_eskul'
          },

          {
            data: 'grade',
            name: 'grade'
          },

          {
            data: 'min',
            name: 'min'
          },

          {
            data: 'max',
            name: 'max'
          },

          {
            data: 'id_std_eskul',
            name: 'id_std_eskul'
          }

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(4).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/StdEskul/getDataStdEskulById','" + data["id_std_eskul"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/StdEskul/deleteDataStdEskul','" + data["id_std_eskul"] + "','" + data["grade"] + "','tbDataStdEskul()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    tbDataSekolah()

    function tbDataSekolah() {

      $('#tbDataSekolah').DataTable({

        destroy: true,

        processing: true,

        serverSide: true,

        pageLength: 50,

        ajax: {

          url: '<?= base_url("/Sekolah/getDataSekolah") ?>'

        },

        columns: [

          {
            data: 'id_sekolah',
            name: 'id_sekolah'
          },

          {
            data: 'nm_sekolah',
            name: 'nm_sekolah'
          },

          {
            data: 'nm_kepsek',
            name: 'nm_kepsek'
          },

          {
            data: 'alamat',
            name: 'alamat'
          },

          {
            data: 'id_sekolah',
            name: 'id_sekolah'
          }

        ],

        "fnCreatedRow": function(row, data, index, aData) {

          var no = index + 1

          $('td', row).eq(0).html("<div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='option1'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div>");

          $('td', row).eq(4).html("<button class='btn btn-secondary btn-sm mr-2' onclick=editData('/Sekolah/getDataSekolahById','" + data["id_sekolah"] + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/StdEskul/deleteDataSekolah','" + data["id_sekolah"] + "','" + encodeURI(data["nm_sekolah"]) + "','tbDataSekolah()') title='Delete'><i class='fa fa-trash'></i></button>");

        }

      });

    }



    function tbDataStdPengetahuan() {

      var ta = $("#ta").val()
      var kls = $("#kelas").val()
      var mapel = $("#mapel").val()

      $.ajax({

        url: "<?= base_url('/StdPengetahuan/getDataStdPengetahuan') ?>",

        type: "POST",

        data: {
          kd_ta: ta,
          kd_kelas: kls,
          kd_mapel: mapel
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataStdPengetahuan > tbody > tr").empty();

          const grade = ["A", "B", "C", "D"];

          $.each(data, function(index, value) {

            $('#tbDataStdPengetahuan > tbody:last').append(

              "<tr>" +

              "<td>" + ++index + "</td>" +

              "<td>A</td>" +

              "<td>" + value.grade_a + "</td>" +

              "<td rowspan='4' style='vertical-align:middle; text-align:center;'><button class='btn btn-secondary btn-sm mr-2' onclick=editData('/StdPengetahuan/getDataStdPengetahuanById','" + value.kd_std_pengetahuan + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/StdPengetahuan/deleteDataStdPengetahuan','" + value.kd_std_pengetahuan + "','','tbDataStdPengetahuan()') title='Delete'><i class='fa fa-trash'></i></button></td>" +

              "</tr>" +

              "<tr>" +

              "<td>" + ++index + "</td>" +

              "<td>B</td>" +

              "<td>" + value.grade_b + "</td>" +

              "</tr>" +

              "<tr>" +

              "<td>" + ++index + "</td>" +

              "<td>C</td>" +

              "<td>" + value.grade_c + "</td>" +

              "</tr>" +

              "<tr>" +

              "<td>" + ++index + "</td>" +

              "<td>D</td>" +

              "<td>" + value.grade_d + "</td>" +

              "</tr>"



            );

          })

        }

      });

    }



    function tbDataStdKeterampilan() {

      var ta = $("#ta").val()
      var kls = $("#kelas").val()
      var mapel = $("#mapel").val()

      $.ajax({

        url: "<?= base_url('/StdKeterampilan/getDataStdKeterampilan') ?>",

        type: "POST",

        data: {
          kd_ta: ta,
          kd_kelas: kls,
          kd_mapel: mapel
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataStdKeterampilan > tbody > tr").empty();

          $.each(data, function(index, value) {

            $('#tbDataStdKeterampilan > tbody:last').append(

              "<tr>" +

              "<td>" + ++index + "</td>" +

              "<td>A</td>" +

              "<td>" + value.grade_a + "</td>" +

              "<td rowspan='4' style='vertical-align:middle; text-align:center;'><button class='btn btn-secondary btn-sm mr-2' onclick=editData('/StdKeterampilan/getDataStdKeterampilanById','" + value.kd_std_keterampilan + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/StdKeterampilan/deleteDataStdKeterampilan','" + value.kd_std_keterampilan + "','','tbDataStdKeterampilan()') title='Delete'><i class='fa fa-trash'></i></button></td>" +

              "</tr>" +

              "<tr>" +

              "<td>" + ++index + "</td>" +

              "<td>B</td>" +

              "<td>" + value.grade_b + "</td>" +

              "</tr>" +

              "<tr>" +

              "<td>" + ++index + "</td>" +

              "<td>C</td>" +

              "<td>" + value.grade_c + "</td>" +

              "</tr>" +

              "<tr>" +

              "<td>" + ++index + "</td>" +

              "<td>D</td>" +

              "<td>" + value.grade_d + "</td>" +

              "</tr>"



            );

          })

        }

      });

    }



    function tbDataNilaiBulanan() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      var id_mapel = $('#mapel').val()

      var bulan = $('#bulan').val()

      $.ajax({

        url: "<?= base_url('/NilaiBulanan/getDataNilaiBulanan') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel,
          id_mapel: id_mapel,
          bulan: bulan
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataNilaiBulanan > tbody:last").empty();

          $.each(data, function(index, value) {

            var no = ++index;

            $('#tbDataNilaiBulanan > tbody:last').append(

              "<tr>" +

              "<td><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='" + value.id_nilai_bulanan + "' name='id_nilai[]'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div></td>" +

              "<td>'" + value.nisn + "</td>" +

              "<td>" + value.nm_pesdik + "</td>" +

              "<td class='text-center'>" + value.score + "</td>" +

              "<td style='vertical-align:middle; text-align:center;'><button type='button' class='btn btn-secondary btn-sm mr-2' onclick=editData('/NilaiBulanan/getDataNilaiBulananById','" + value.id_nilai_bulanan + "') title='Edit'><i class='fa fa-edit'></i></button></td>" +

              "</tr>"

            );

          })

        }

      });

    }



    function tbDataNilaiEskul() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      $.ajax({

        url: "<?= base_url('/NilaiEskul/getDataNilaiEskul') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataNilaiEskul > tbody:last").empty();

          $.each(data, function(index, value) {

            var no = ++index;

            $('#tbDataNilaiEskul > tbody:last').append(

              "<tr>" +

              "<td><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='" + value.id_nilai_eskul + "' name='id_nilai[]'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div></td>" +

              "<td>'" + value.nisn + "</td>" +

              "<td>" + value.input + "" + value.nm_pesdik + "</td>" +

              "<td class='text-center'>" + value.eskul1 + "</td>" +

              "<td class='text-center' width='60px'>" + value.nilai1 + "</td>" +

              "<td class='text-center'>" + value.eskul2 + "</td>" +

              "<td class='text-center' width='60px'>" + value.nilai2 + "</td>" +

              "<td class='text-center'>" + value.eskul3 + "</td>" +

              "<td class='text-center' width='60px'>" + value.nilai3 + "</td>" +

              "<td class='text-center'>" + value.eskul4 + "</td>" +

              "<td class='text-center' width='60px'>" + value.nilai4 + "</td>" +

              "<td style='vertical-align:middle; text-align:center;'><button type='button' class='btn btn-secondary btn-sm mr-2' onclick=editData('/NilaiEskul/getDataNilaiEskulById','" + value.id_nilai_eskul + "') title='Edit'><i class='fa fa-edit'></i></button></td>" +

              "</tr>"

            );

          })

        }

      });

    }



    function tbDataWaliKelas() {

      var ta = $('#ta').val()

      $.ajax({

        url: "<?= base_url('/WaliKelas/getDataWaliKelas') ?>",

        type: "POST",

        data: {
          ta: ta
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataWaliKelas > tbody:last").empty();

          $.each(data, function(index, value) {

            var no = ++index;

            $('#tbDataWaliKelas > tbody:last').append(

              "<tr>" +

              "<td><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='" + value.id_wali_kelas + "' name='id_nilai[]'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div></td>" +

              "<td>" + value.nip_guru + "</td>" +

              "<td>" + value.nm_guru + "</td>" +

              "<td class='text-center'>" + value.nm_rombel + "</td>" +

              "<td style='vertical-align:middle; text-align:center;'><button type='button' class='btn btn-secondary btn-sm mr-2' onclick=editData('/WaliKelas/getDataWaliKelasById','" + value.id_wali_kelas + "') title='Edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm' onclick=confirmDelete('/WaliKelas/deleteDataWaliKelas','" + value.id_wali_kelas + "','" + encodeURI(value.nm_guru) + "','tbDataWaliKelas()') title='Delete'><i class='fa fa-trash'></i></button></td>" +

              "</tr>"

            );

          })

        }

      });

    }



    function tbDataLedger() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      $.ajax({

        url: "<?= base_url('/Ledger/getDataLedger') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataLedger > tbody:last").empty();

          $.each(data, function(index, value) {

            var no = ++index;

            $('#tbDataLedger > tbody:last').append(

              "<tr>" +

              "<td><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='" + value.id_nilai_eskul + "' name='id_nilai[]'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div></td>" +

              // "<td>'"+ value.nisn +"</td>"+

              "<td>" + value.input + "" + value.nm_pesdik + "</td>" +

              "<td class='text-center'>" + value.eskul1 + "</td>" +

              "<td class='text-center' width='60px'>" + value.nilai1 + "</td>" +

              "<td class='text-center'>" + value.eskul2 + "</td>" +

              "<td class='text-center' width='60px'>" + value.nilai2 + "</td>" +

              "<td class='text-center'>" + value.eskul3 + "</td>" +

              "<td class='text-center' width='60px'>" + value.nilai3 + "</td>" +

              "<td class='text-center'>" + value.eskul4 + "</td>" +

              "<td class='text-center' width='60px'>" + value.nilai4 + "</td>" +

              "<td style='vertical-align:middle; text-align:center;'><button type='button' class='btn btn-secondary btn-sm mr-2' onclick=editData('/NilaiEskul/getDataNilaiEskulById','" + value.id_nilai_eskul + "') title='Edit'><i class='fa fa-edit'></i></button></td>" +

              "</tr>"

            );

          })

        }

      });

    }



    function tbLadger() {

      var id_kelas = $('#kelas').val()

      $.ajax({

        url: "<?= base_url('/Mapel/getListMapel') ?>",

        type: "POST",

        data: {
          id_kelas: id_kelas
        },

        dataType: "JSON",

        success: function(data) {

          var colspan = data.length

          $("#colspan").attr('colspan', colspan * 2);

          $("#list_mapel").empty();

          $.each(data, function(index, value) {

            var no = ++index;

            if (!value.nm_mapel_ing) {

              var mapel = value.nm_mapel

            } else {

              var mapel = value.nm_mapel_ing

            }

            $('#list_mapel').append(

              "<th style='vertical-align: middle;' colspan='2'>" + mapel + "</th>"

            );

          })

          $("#list_nilai").empty();

          $.each(data, function(index, value) {

            $('#list_nilai').append(

              "<th style='vertical-align: middle; text-align:center; background:#002366;'>P</th>" +

              "<th style='vertical-align: middle; text-align:center; background:#50CB93;'>K</th>"

            );

          })

        }

      });

    }



    function getRombelByKls() {

      var id = $('#kelas').val()

      $.ajax({

        url: "<?= base_url('Rombel/getDataRombelByKls') ?>",

        type: "POST",

        data: {
          id: id
        },

        dataType: "JSON",

        success: function(data) {

          $("#rombel").empty();

          $("#rombel").append(

            "<option value=''>Select Rombel</option>"

          );

          $.each(data, function(index, value) {

            $("#rombel").append(

              "<option value='" + value.id_rombel + "'>" + value.nm_rombel + "</option>"

            );

          })

        }

      })

    }



    function tbDataNilaiMapel() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      var id_mapel = $('#mapel').val()

      $.ajax({

        url: "<?= base_url('/NilaiMapel/getDataNilaiMapel') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel,
          id_mapel: id_mapel
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataNilaiMapel > tbody:last").empty();

          $.each(data, function(index, value) {

            var no = ++index;

            $('#tbDataNilaiMapel > tbody:last').append(

              "<tr>" +

              "<td><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='" + value.id_nilai_mapel + "' name='id_nilai[]'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div></td>" +

              "<td>'" + value.nisn + "</td>" +

              "<td>" + value.nm_pesdik + "</td>" +

              "<td class='text-center'>" + value.ph + "</td>" +

              "<td class='text-center'>" + value.pts + "</td>" +

              "<td class='text-center'>" + value.pat + "</td>" +

              "<td class='text-center'>" + value.na + "</td>" +

              "<td class='text-center'>" + value.keterampilan + "</td>" +

              "<td style='vertical-align:middle; text-align:center;'><button type='button' class='btn btn-secondary btn-sm mr-2' onclick=editData('/NilaiMapel/getDataNilaiMapelById','" + value.id_nilai_mapel + "') title='Edit'><i class='fa fa-edit'></i></button></td>" +

              "</tr>"

            );

          })

        }

      });

    }



    function formUploadNilai() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      var id_mapel = $('#mapel').val()

      if (!ta || !id_kelas || !id_rombel || !id_mapel) {

        $("#mapel").addClass("is-invalid")

      } else {

        $('#form-upload').show(500), $('#btn-submit').text('UPLOAD DATA')

      }

    }

    function formUploadAbsensi() {
      var ta = $('#ta').val()
      var id_kelas = $('#kelas').val()
      var id_rombel = $('#rombel').val()
      if (!ta || !id_kelas || !id_rombel) {
        $("#rombel").addClass("is-invalid")
      } else {
        $('#form-upload').show(500), $('#btn-submit').text('UPLOAD DATA')
      }
    }



    function tbDataNilaiAfektif() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      $.ajax({

        url: "<?= base_url('/NilaiAfektif/getDataNilaiAfektif') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataNilaiAfektif > tbody:last").empty();

          $.each(data, function(index, value) {

            var no = ++index;

            if (value.spiritual == 'SANGAT BAIK') {

              var bg1 = 'bg-blue'

            } else if (value.spiritual == 'BAIK') {

              var bg1 = 'bg-green'

            } else if (value.spiritual == 'CUKUP') {

              var bg1 = 'bg-yellow'

            } else if (value.spiritual == 'KURANG') {

              var bg1 = 'bg-red'

            }

            if (value.sosial == 'SANGAT BAIK') {

              var bg2 = 'bg-blue'

            } else if (value.sosial == 'BAIK') {

              var bg2 = 'bg-green'

            } else if (value.sosial == 'CUKUP') {

              var bg2 = 'bg-yellow'

            } else if (value.sosial == 'KURANG') {

              var bg2 = 'bg-red'

            }

            $('#tbDataNilaiAfektif > tbody:last').append(

              "<tr>" +

              "<td><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='" + value.id_nilai_afektif + "' name='id_nilai[]'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div></td>" +

              "<td>'" + value.input + "" + value.nisn + "</td>" +

              "<td>" + value.nm_pesdik + "</td>" +

              "<td class='text-center " + bg1 + "'>" + value.spiritual + "</td>" +

              "<td class='text-center " + bg2 + "'>" + value.sosial + "</td>" +

              "</tr>"

            );

          })

        }

      });

    }



    function deleteNilaiAfektif() {

      Swal.fire({

        title: 'Are you sure ?',

        text: "You want to delete selected data",

        customClass: 'swal-wide',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#32afa9',

        cancelButtonColor: '#d8345f',

        confirmButtonText: 'Yes, sure!',

      }).then((result) => {

        if (result.value) {

          $.ajax({

            url: "<?= base_url('/NilaiAfektif/deleteDataNilaiAfektif') ?>",

            type: "POST",

            data: new FormData($('#nilaiAfektif')[0]),

            processData: !1,

            contentType: !1,

            cache: !1,

            async: !1,

            dataType: "JSON",

            success: function(e) {

              switch (e[0]) {

                case "Success Delete":

                  tbDataNilaiAfektif()

                  Toast.fire({

                    icon: 'success',

                    title: 'Delete Data Success',

                  });
                  break;

                case "Failed Delete":

                  Toast.fire({

                    icon: 'error',

                    title: 'Delete Data Failed',

                  });
                  break;

              }

            },

          });

        }

      })

    }



    function deleteNilaiEskul() {

      Swal.fire({

        title: 'Are you sure ?',

        text: "You want to delete selected data",

        customClass: 'swal-wide',

        icon: 'warning',

        showCancelButton: true,

        confirmButtonColor: '#32afa9',

        cancelButtonColor: '#d8345f',

        confirmButtonText: 'Yes, sure!',

      }).then((result) => {

        if (result.value) {

          $.ajax({

            url: "<?= base_url('/NilaiEskul/deleteDataNilaiEskul') ?>",

            type: "POST",

            data: new FormData($('#nilaiEskul')[0]),

            processData: !1,

            contentType: !1,

            cache: !1,

            async: !1,

            dataType: "JSON",

            success: function(e) {

              switch (e[0]) {

                case "Success Delete":

                  tbDataNilaiEskul()

                  Toast.fire({

                    icon: 'success',

                    title: 'Delete Data Success',

                  });
                  break;

                case "Failed Delete":

                  Toast.fire({

                    icon: 'error',

                    title: 'Delete Data Failed',

                  });
                  break;

              }

            },

          });

        }

      })

    }



    function tbDataAbsensi() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      $.ajax({

        url: "<?= base_url('/Absensi/getDataAbsensi') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataAbsensi > tbody:last").empty();

          $.each(data, function(index, value) {

            var no = ++index;

            $('#tbDataAbsensi > tbody:last').append(

              "<tr>" +

              "<td><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='" + value.id_absensi + "' name='id_nilai[]'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div></td>" +

              "<td>'" + value.nisn + "</td>" +

              "<td>" + value.input + "" + value.nm_pesdik + "</td>" +

              "<td class='text-center'>" + value.sakit + "</td>" +

              "<td class='text-center' width='60px'>" + value.izin + "</td>" +

              "<td class='text-center' width='60px'>" + value.alpha + "</td>" +

              "<td style='vertical-align:middle; text-align:center;'><button type='button' class='btn btn-secondary btn-sm mr-2' onclick=editData('/Absensi/getDataAbsensiById','" + value.id_absensi + "') title='Edit'><i class='fa fa-edit'></i></button></td>" +

              "</tr>"

            );

          })

        }

      });

    }



    function printTest() {

      var mywindow = window.open("", "PRINT");

      mywindow.document.body.innerHTML = $("#print_area")[0].outerHTML;

      mywindow.focus();

      mywindow.print();

      mywindow.close();

      return true;

    }



    function tbDataRaporBulanan() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      var bulan = $('#bulan').val()

      $.ajax({

        url: "<?= base_url('/RaporBulanan/getDataRaporBulanan') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel,
          bulan: bulan
        },

        dataType: "JSON",

        success: function(data) {



          if (data.length) {

            $("#tbDataRaporBulanan > tbody:last").empty();

            $.each(data, function(index, value) {

              var no = ++index;

              $('#tbDataRaporBulanan > tbody:last').append(

                "<tr>" +

                "<td><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='" + value.id_nilai_bulanan + "' name='id_nilai[]'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div></td>" +

                "<td>'" + value.nisn + "</td>" +

                "<td>" + value.nm_pesdik + "</td>" +

                "<td style='vertical-align:middle; text-align:center;'><a target='_blank' href='<?= base_url() ?>/administrator/rapor-nilai-bulanan?id=" + value.id_pesdik + "&ta=" + ta + "&kls=" + id_kelas + "&rombel=" + id_rombel + "&month=" + bulan + "' class='btn btn-secondary btn-sm mr-2'><i class='fa fa-search'></i> Show Rapor</a></td>" +

                "</tr>"

              );

            })

          } else {

            $("#tbDataRaporBulanan > tbody:last").empty();

            $('#tbDataRaporBulanan > tbody:last').append(

              "<tr>" +

              "<td colspan='4' align='center'>Rapor Belum Diterbitkan</td>" +

              "</tr>"

            );

          }

        }

      });

    }



    function checkStatusRaporBulanan() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      var bulan = $('#bulan').val()

      $.ajax({

        url: "<?= base_url('/RaporBulanan/checkStatusRaporBulanan') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel,
          bulan: bulan
        },

        dataType: "JSON",

        success: function(res) {

          if (res.status == "SUDAH TERBIT") {

            tbDataRaporBulanan()

            $("#btnStatus").show()

            $("#btnStatus").text(res.status)

            $("#btnStatus").removeClass("btn-danger");

            $("#btnStatus").addClass("btn-success");

          } else {

            $("#btnStatus").show()

            $("#btnStatus").text(res.status)

            $("#btnStatus").addClass("btn-danger");

            $("#btnStatus").removeClass("btn-success");

          }

        }

      });

    }



    function formReleaseRaporBulanan() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      var bulan = $('#bulan').val()

      $.ajax({

        url: "<?= base_url('/RaporBulanan/getAttrRaporBulanan') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel,
          bulan: bulan
        },

        dataType: "JSON",

        success: function(res) {

          $("#nip_guru").val("")

          $("#kota_terbit").val("")

          $("#tgl_terbit").val("")

          $("#form-input").show()

          if (res.id_rapor_bulanan != "") {

            $("#key").val(res.id_rapor_bulanan)

            $("#nip_guru").val(res.wali_kelas)

            $("#kota_terbit").val(res.kota_terbit)

            $("#tgl_terbit").val(res.tgl_terbit)

            $("#form-input").show()

          }

        }

      });

    }



    function tbDataRaporSemester() {

      checkStatusRaporSemester()

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      $.ajax({

        url: "<?= base_url('/RaporSemester/getDataRaporSemester') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel
        },

        dataType: "JSON",

        success: function(data) {

          $("#tbDataRaporSemester > tbody:last").empty();

          if (data.length) {

            $.each(data, function(index, value) {

              var no = ++index;

              $('#tbDataRaporSemester > tbody:last').append(

                "<tr>" +

                "<td><div class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' id='customCheckbox[" + no + "]' value='' name='id_nilai[]'><label for='customCheckbox[" + no + "]' class='custom-control-label'>" + no + "</label></div></td>" +

                "<td>'" + value.nisn + "</td>" +

                "<td>" + value.nm_pesdik + "</td>" +

                "<td style='vertical-align:middle; text-align:center;'><a target='_blank' href='<?= base_url() ?>/administrator/rapor-semester?id=" + value.id_pesdik + "&ta=" + ta + "&kls=" + id_kelas + "&rombel=" + id_rombel + "' class='btn btn-secondary btn-sm mr-2'><i class='fa fa-print'></i> Cetak Rapor</a></td>" +

                "</tr>"

              );

            })

          } else {

            $('#tbDataRaporSemester > tbody:last').append(

              "<tr>" +

              "<td colspan='4' align='center'>Rapor Belum Diterbitkan</td>" +

              "</tr>"

            );

          }

        }

      });

    }



    function checkStatusRaporSemester() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      $.ajax({

        url: "<?= base_url('/RaporSemester/checkStatusRaporSemester') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel
        },

        dataType: "JSON",

        success: function(res) {

          if (res.status == "SUDAH TERBIT") {

            $("#btnStatus").show()

            $("#btnStatus").text(res.status)

            $("#btnStatus").removeClass("btn-danger");

            $("#btnStatus").addClass("btn-success");

          } else {

            $("#btnStatus").show()

            $("#btnStatus").text(res.status)

            $("#btnStatus").addClass("btn-danger");

            $("#btnStatus").removeClass("btn-success");

          }

        }

      });

    }



    function formReleaseRaporSemester() {

      var ta = $('#ta').val()

      var id_kelas = $('#kelas').val()

      var id_rombel = $('#rombel').val()

      $.ajax({

        url: "<?= base_url('/RaporSemester/getAttrRaporSemester') ?>",

        type: "POST",

        data: {
          ta: ta,
          id_kelas: id_kelas,
          id_rombel: id_rombel
        },

        dataType: "JSON",

        success: function(res) {

          $("#nip_guru").val("")

          $("#kota_terbit").val("")

          $("#tgl_terbit").val("")

          $("#form-input").show()

          if (res.id_rapor_bulanan != "") {

            $("#key").val(res.id_rapor_semester)

            $("#nip_guru").val(res.wali_kelas)

            $("#kota_terbit").val(res.kota_terbit)

            $("#tgl_terbit").val(res.tgl_terbit)

            $("#form-input").show()

          }

        }

      });

    }
  </script>

</body>

</html>