 @extends('index')

 @section('pageTittle','Dashboard')
 @section('webTittle','Dashboard')

 @section('content')
 <div class="main-content-inner">
     <!-- sales report area start -->
     <div class="sales-report-area mt-5 mb-5">
         <div class="row">
             <div class="col-md-6">
                 <div class="single-report mb-xs-30">
                     <div class="s-report-inne">
                       <div id="siswa-ekskul" width="100%"></div>
                     </div>

                 </div>
             </div>
             <div class="col-md-6">
                 <div class="single-report mb-xs-30">
                   <div id="siswa-perkelas" width="100%"></div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <script type="text/javascript">
   Highcharts.chart('siswa-ekskul', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Presentasi Siswa yang Mengikuti Ekskul'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Chrome',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Internet Explorer',
            y: 11.84
        }, {
            name: 'Firefox',
            y: 10.85
        }, {
            name: 'Edge',
            y: 4.67
        }, {
            name: 'Safari',
            y: 4.18
        }, {
            name: 'Sogou Explorer',
            y: 1.64
        }, {
            name: 'Opera',
            y: 1.6
        }, {
            name: 'QQ',
            y: 1.2
        }, {
            name: 'Other',
            y: 2.61
        }]
    }]
  });
  Highcharts.chart('siswa-perkelas', {
   chart: {
       plotBackgroundColor: null,
       plotBorderWidth: null,
       plotShadow: false,
       type: 'column'
   },
   title: {
       text: 'Siswa Mengikuti Ekskul Per Kelas'
   },
   tooltip: {
       pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
   },
   accessibility: {
       point: {
           valueSuffix: '%'
       }
   },
   plotOptions: {
       pie: {
           allowPointSelect: true,
           cursor: 'pointer',
           dataLabels: {
               enabled: true,
               format: '<b>{point.name}</b>: {point.percentage:.1f} %'
           }
       }
   },
   series: [{
       name: 'Brands',
       colorByPoint: true,
       data: [{
           name: 'Chrome',
           y: 61.41,
           sliced: true,
           selected: true
       }, {
           name: 'Internet Explorer',
           y: 11.84
       }, {
           name: 'Firefox',
           y: 10.85
       }, {
           name: 'Edge',
           y: 4.67
       }, {
           name: 'Safari',
           y: 4.18
       }, {
           name: 'Sogou Explorer',
           y: 1.64
       }, {
           name: 'Opera',
           y: 1.6
       }, {
           name: 'QQ',
           y: 1.2
       }, {
           name: 'Other',
           y: 2.61
       }]
   }]
 });
 </script>
@endsection
