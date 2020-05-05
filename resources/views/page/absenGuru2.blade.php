<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Absen Guru</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/slide-button.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
  </head>
  <body>
    <div class="container fixed-top mt-5">
      <div class="row">
        <div class="col-sm-12">
          <h1 class="text-center" style="color:white;font-weight:bold;">Sistem Absensi Online</h1>
          <h2 class="text-center" style="color:white;font-weight:bold;">SMA Negeri 6 Kota Tangerang</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-sm-6 col-sm-12">
          <div class="card">
              <div class="card-header">
                  <h3>Absen Guru</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Nama Guru</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Budi Yusuf">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Bahasa Indonesia - 08:00 s.d 09:00">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Kelas</label>
                      <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="XII.MIPA.2">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <h1 class="text-center">Poin Anda</h1>
                    <h1 class="text-center" style="font-size : 5vw;">100</h1>
                  </div>
                </div>

              </div>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-sm-12">
          <div id="button-background">
          	<span class="slide-text">Absen</span>
          	<div id="slider">
          		<i id="locker" class="fa fa-angle-double-right fa-4x"></i>
              <!--fa-check-->
          	</div>
          </div>

        </div>
      </div>
    </div>
  </body>
</html>

<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
  var initialMouse = 0;
  var slideMovementTotal = 0;
  var mouseIsDown = false;
  var slider = $('#slider');

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
  slider.addClass('unlocked');
  $('#locker').removeClass('fa-angle-double-right').addClass('fa-check');
  $('#locker').text(" Selesai")
  setTimeout(function(){
    slider.on('click tap', function(event){
      if (confirm("Selesaikan Jam Pelajaran?")) {
        if (!slider.hasClass('unlocked'))
          return;
        slider.removeClass('unlocked');
        $('#locker').removeClass('fa-check').addClass('fa-angle-double-right');
        $('#locker').text("")
        slider.off('click tap');
      }
    });
  }, 0);
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

</script>
