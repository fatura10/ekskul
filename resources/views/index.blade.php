<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SMP Al Itijhad - @yield('webTittle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/metisMenu.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="/assets/css/typography.css">
    <link rel="stylesheet" href="/assets/css/default-css.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="/assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- jquery latest version -->
    <script src="/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <style media="screen">
      .liveSearch{
        position: absolute;
        background: #ececec;
        border-radius: 15px;
        padding: 3vh;
        width: 100%;
        display: none;
      }
      .nav-item{
        margin : 5px;
      }
    </style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include('include.sidebar')
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            @include('include.header')
            <!-- header area end -->
            <!-- page title area start -->
            @include('include.pageHeader')
            <!-- page title area end -->
            @yield('content')
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        @include('include.footer')
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->

    <!-- offset area end -->

    <!-- bootstrap 4 js -->
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/metisMenu.min.js"></script>
    <script src="/assets/js/jquery.slimscroll.min.js"></script>
    <script src="/assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>

    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="/assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="/assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="/assets/js/plugins.js"></script>
    <script src="/assets/js/scripts.js"></script>
    <script type="text/javascript">
      $('select[name="id_provinsi"]').change(function(){
        $.get('/getKota?id_provinsi='+$(this).val(),function(data){
          console.log(data);
          $('.kotaOption').remove();
          $.each(data,function(){
              html='<option class="kotaOption" value="'+this.id_kota+'">'+this.nama+'</option>';
              $('select[name="id_kota"]').append(html)
          })
          $('select[name="id_kota"]').attr('disabled',false);
        })
      })
      $('select[name="id_provinsi_ortu[0]"]').change(function(){
        $.get('/getKota?id_provinsi='+$(this).val(),function(data){
          console.log(data);
          $('.kotaOptionAyah').remove();
          $.each(data,function(){
              html='<option class="kotaOptionAyah" value="'+this.id_kota+'">'+this.nama+'</option>';
              $('select[name="id_kota_ortu[0]"]').append(html)
          })
          $('select[name="id_kota_ortu[0]"]').attr('disabled',false);
        })
      })
      $('select[name="id_provinsi_ortu[1]"]').change(function(){
        $.get('/getKota?id_provinsi='+$(this).val(),function(data){
          console.log(data);
          $('.kotaOptionIbu').remove();
          $.each(data,function(){
              html='<option class="kotaOptionIbu" value="'+this.id_kota+'">'+this.nama+'</option>';
              $('select[name="id_kota_ortu[1]"]').append(html)
          })
          $('select[name="id_kota_ortu[1]"]').attr('disabled',false);
        })
      })
    </script>
</body>

</html>
