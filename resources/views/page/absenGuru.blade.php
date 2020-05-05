<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Absen Guru</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/css/slide-button.css">
    <link rel="stylesheet" href="../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <style>
    .col-xs-6{
      width: 50% !important;
      float :left !important;
    }
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        /*padding-top: 20px;*/
        padding-bottom: 40px;
    }
    </style>
</head>

<body style="background-image:url('/assets/images/background.jpg'); background-repeat: no-repeat; background-size:cover;">
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container mt-2">
        <div class="card ">
            <div class="card-header text-center p-2">
              <div class="col-sm-12">
                <h3 class="text-center m-0" style="font-weight:bold;">Sistem Absensi Online</h3>
                <h4 class="text-center m-0" style="font-weight:bold;">SMA Negeri 6 Kota Tangerang</h4>
              </div>
            </div>
            <div class="card-body p-2">
              <div class="col-sm-12 text-center">
                <a href="#" class="btn btn-success btn-sm m-0" data-toggle="modal" data-target="#jadwal">Lihat Jadwal</a>
              </div>
              @if($absenData!=null)
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group row p-0">
                      <label for="staticEmail" class="col-sm-12 col-form-label">Nama Guru</label>
                      <div class="col-sm-12">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$absenData->nama_guru}}">
                      </div>
                    </div>
                    <div class="form-group row p-0">
                      <label for="staticEmail" class="col-sm-12 col-form-label">Mata Pelajaran - <label style="color:black">{{$absenData->hari}}, {{$absenData->datenow}}</label> </label>
                      <div class="col-sm-12">
                        <input type="text" readonly class="form-control-plaintext" id="hour" data-starting="{{$absenData->starting_hour}}" data-finish="{{$absenData->finishing_hour}}" value="{{$absenData->mapel}} - {{$absenData->starting_hour}} s.d {{$absenData->finishing_hour}}">
                      </div>
                    </div>
                    <div class="form-group row p-0">
                      <label for="staticEmail" class="col-sm-12 col-form-label">Kelas</label>
                      <div class="col-sm-12">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$absenData->nama}}">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-6">
                    <h4 class="text-center m-0">Poin Anda</h4>
                    <h1 id="poin" class="text-center m-0" style="font-size : 5vh;">{{($absenData->poin==null?0:$absenData->poin)}}</h1>
                  </div>
                  <div class="col-xs-6">
                    <h4 class="text-center m-0">Durasi</h4>
                    <h1 class="text-center m-0" style="font-size : 5vh;" id="durasi">00:00:00</h1>
                  </div>
                </div>

            </div>

        </div>
        <div class="row">
          <div class="col-sm-12">
            <div id="button-background">
              <span class="slide-text">Absen</span>
              <div id="slider" data-jadwal="{{$absenData->id_jadwal}}" data-guru="{{$absenData->id_guru}}">
                <i id="locker" class="fa fa-angle-double-right fa-3x"></i>
                <!--fa-check-->
              </div>
            </div>
          </div>
        </div>

    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->

    <script type="text/javascript">

      var initialMouse = 0;
      var slideMovementTotal = 0;
      var mouseIsDown = false;
      var slider = $('#slider');
      var starting_hour='<?=$absenData->absen_in?>'=="" || '<?=$absenData->absen_out?>' != ""?"00:00:00":'<?=$absenData->absen_in?>'
      var id_absen='<?=$absenData->id_absen?>'==""?null:'<?=$absenData->id_absen?>'
      //alert(starting_hour)
      if (starting_hour!="00:00:00") {
        //alert(starting_hour)
        // var currentMouse = event.clientX || event.changedTouches[0].pageX;
        // var relativeMouse = currentMouse - initialMouse;
        mouseSlider()
        timer();
      }

      slider.on('mousedown touchstart', function(event){
      mouseIsDown = true;
      slideMovementTotal = $('#button-background').width() - $(this).width() + 10;
      initialMouse = event.clientX || event.originalEvent.touches[0].pageX;
      });

      $(document.body, '#slider').on('mouseup touchend', function (event) {
      if (!mouseIsDown)
        return;
      mouseIsDown = false;
      var currentMouse = event.clientX || event.changedTouches[0].pageX;
      var relativeMouse = currentMouse - initialMouse;

      if (relativeMouse < slideMovementTotal) {
        $('.slide-text').fadeTo(300, 1);
        slider.animate({
          left: "-10px"
        }, 300);
        return;
      }
      mouseSlider()
      if (starting_hour=="00:00:00") {
        $.ajax({
          type: "POST",
          url: '/api/absenIn',
          data: {
            "id_jadwal":$('#slider').data('jadwal'),
            "id_guru":$('#slider').data('guru'),
            "starting_hour":$('#hour').data('starting')
          },
          success: function(data){
            console.log(data);
            id_absen = data.params.id_absen
            $('#poin').text(data.params.poin)
            timer();
          }
        });
      } else {
        timer();
      }
      /*setTimeout(function(){
        slider.on('click tap', function(event){
          finish()
        });
      }, 0);*/
      });

      $(document.body).on('mousemove touchmove', function(event){
      if (!mouseIsDown)
        return;

      var currentMouse = event.clientX || event.originalEvent.touches[0].pageX;
      var relativeMouse = currentMouse - initialMouse;
      var slidePercent = 1 - (relativeMouse / slideMovementTotal);

      $('.slide-text').fadeTo(0, slidePercent);

      if (relativeMouse <= 0) {
        slider.css({'left': '-10px'});
        return;
      }
      if (relativeMouse >= slideMovementTotal + 10) {
        slider.css({'left': slideMovementTotal + 'px'});
        return;
      }
      slider.css({'left': relativeMouse - 10});
      });

      //setTimeout(function(){
        slider.on('click tap', function(event){
          finish()
        });
      //}, 0);
      function finish()
      {
        if (confirm("Selesaikan Jam Pelajaran?")) {
          clearTimeout(t);
          ///reset Timer
          /*
          h1.textContent = "00:00:00";
          seconds = 0; minutes = 0; hours = 0;
          */
          ///
          //alert($('#slider').data("jadwal"))
          if (!slider.hasClass('unlocked'))
            return;
          slider.removeClass('unlocked');
          $('#locker').removeClass('fa-check').addClass('fa-angle-double-right');
          $('#locker').text("")
          $('#slider').css({"background-color":"white","color":"#71748d"})
          slider.off('click tap');
          absenOut()
        }
      }

      function absenOut()
      {
        $.ajax({
          type: "PUT",
          url: '/api/absenOut?id_absen='+id_absen+'&finishing_hour='+$('#hour').data('finish'),
          success: function(data){
            console.log(data);
            location.reload()
          }
        });
      }


      /*Stopwatch*/
      var startTime = starting_hour.split(":");
      var h1 = document.getElementsByTagName('h1')[0],
          start = document.getElementById('start'),
          stop = document.getElementById('stop'),
          clear = document.getElementById('clear'),
          //seconds = 0, minutes = 0, hours = 0,
          seconds = parseInt(startTime[2]), minutes = parseInt(startTime[1]), hours = parseInt(startTime[0]),
          t;

      function add() {
          seconds++;
          if (seconds >= 60) {
              seconds = 0;
              minutes++;
              if (minutes >= 60) {
                  minutes = 0;
                  hours++;
              }
          }

          document.getElementById("durasi").textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

          timer();
      }
      function timer() {
          t = setTimeout(add, 1000);
      }

      function mouseSlider()
      {
        slider.addClass('unlocked');
        $('#locker').removeClass('fa-angle-double-right').addClass('fa-check');
        $('#locker').text(" Selesai")
        $('#slider').css({"background-color":"green","color":"white"})
      }


      //clearTimeout(t);
      /* Start button */
      //start.onclick = timer;

      /* Stop button */
      // stop.onclick = function() {
      //     clearTimeout(t);
      // }

      /* Clear button */
      // clear.onclick = function() {
      //     h1.textContent = "00:00:00";
      //     seconds = 0; minutes = 0; hours = 0;
      // }

      /*End Stopwatch*/

    </script>
    @else
      <h2 class="mt-2">Jadwal Tidak Ditemukan</h2>
    @endif
</body>


<!-- Modal -->
<div class="modal fade" id="jadwal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lihat Jadwal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" class="btn btn-success" href="#home">Jadwal</a></li>
          <li><a data-toggle="tab" class="btn btn-info" href="#menu1">History</a></li>
        </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active p-2">
            <h3>Jadwal Anda</h3>
            <div class="row">
              <div class="col-sm-12 table-responsive">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Hari</th>
                        <th class="text-center">Jam</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Mata Pelajaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php($i=1)
                      @php($jam = ['08:00 s.d 09:00','09:00 s.d 10:00','10:00 s.d 11:00','11:00 s.d 12:00','13:00 s.d 14:00','14:00 s.d 15:00'])

                        @foreach($dataJapel as $data)
                          <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td class="text-center">{{$data->hari}}</td>
                            <td class="text-center">{{$jam[$data->jam]}}</td>
                            <td class="text-center">{{$data->nama}}</td>
                            <td class="text-center">{{$data->mapel}}</td>
                          </tr>
                        @endforeach

                    </tbody>
                  </table>
              </div>
            </div>
          </div>
          <div id="menu1" class="tab-pane fade  p-2">
            <h3>History Absen</h3>
            <div class="row">
              <div class="col-sm-12 table-responsive table-bordered">
                <table class="table">
                    <thead class="bg-light">
                        <tr>
                            <th rowspan="2" class="text-center align-middle">#</th>
                            <th rowspan="2" class="text-center align-middle">Mata Pelajaran</th>
                            <th rowspan="2" class="text-center align-middle">Hari</th>
                            <th colspan="2" class="text-center">Jam</th>
                            <th colspan="2" class="text-center">Absen</th>
                        </tr>
                        <tr>
                          <th class="text-center">Mulai</th>
                          <th class="text-center">Selesai</th>
                          <th class="text-center">Absen In</th>
                          <th class="text-center">Absen Out</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php($i=1)
                      @php($jam = ['08:00 s.d 09:00','09:00 s.d 10:00','10:00 s.d 11:00','11:00 s.d 12:00','13:00 s.d 14:00','14:00 s.d 15:00'])
                      @foreach($dataAbsen as $data)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td class="text-center">{{$data->mapel}}</td>
                            <td class="text-center">{{$data->hari}}</td>
                            <td class="text-center">{{$data->starting_hour}}</td>
                            <td class="text-center">{{$data->finishing_hour}}</td>
                            <td class="text-center">{{$data->absen_in}}</td>
                            <td class="text-center">{{$data->absen_out}}</td>

                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</html>
