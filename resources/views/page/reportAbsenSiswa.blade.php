 @extends('index')

 @section('pageTittle','Master Ekskul')
 @section('webTittle','Ekskul')

 @section('content')


<div class="row">
    <!-- ============================================================== -->

    <!-- ============================================================== -->

                  <!-- recent orders  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Absen Ekskul</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <h1 class="text-center">Absensi Ekstrakulikuler {{$dataEkskul->nama}} </h1>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <h4 class="text-center">Hari Latihan : {{$dataEkskul->hari}} </h4>
                </div>
                <div class="col-sm-6">
                  <h4 class="text-center">Jam Latihan : {{$dataEkskul->starting_hour}} s.d {{$dataEkskul->finishing_hour}}</h4>
                </div>
              </div>
            </br>
              <div class="table-responsive">
                  <table class="table">
                      <thead class="bg-light">
                          <tr>
                              <th class="text-center">#</th>
                              <th class="text-center">Nama Siswa</th>
                              <th class="text-center">Kelas</th>
                              <th class="text-center">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php($i=1)
                        @foreach($dataAbsen as $data)
                          <tr>
                            <td class="text-center">{{($i++)}}</td>
                            <td class="text-center">{{$data->nama_siswa}}</td>
                            <td class="text-center">{{$data->nama}}</td>
                            <td class="text-center">{{($data->tglLatihan==null?'Tidak Hadir':$data->absen_time)}}</td>
                        @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end recent orders  -->
</div>
<script type="text/javascript">
  $('.btn-hadir').click(function(){
    var btnHadir = $(this)
    data = {
      id_siswa : $(this).data('idsiswa'),
      id_jadwal : $(this).data('idjadwal'),
      id_pel : $(this).data('idpel'),
      id_absen : $(this).data('idabsen'),
      status : $(this).data('status')
    }
    if (data.id_absen!="") {
      $.ajax({
        type: "POST",
        url: '/api/absen/out',
        data: data,
        success: function(res){
          console.log(res);
          if (res.error) {
            alert(res.message)
            return
          }
          if (btnHadir.hasClass('btn-success')) {
            btnHadir.text('Tidak Hadir')
            btnHadir.data('status',res.params.status)
            btnHadir.removeClass('btn-success').addClass('btn-danger')
          } else {
            btnHadir.text('Hadir')
            btnHadir.data('status',res.params.status)
            btnHadir.removeClass('btn-danger').addClass('btn-success')
          }

        }
      });
    } else {
      $.ajax({
        type: "POST",
        url: '/api/absen/in',
        data: data,
        success: function(res){
          console.log(res);
          if (res.error) {
            alert(res.message)
            return
          }
          if (btnHadir.hasClass('btn-success')) {
            btnHadir.text('Tidak Hadir')
            btnHadir.data('idabsen',res.params.id_absen)
            btnHadir.data('status',res.params.status)
            btnHadir.removeClass('btn-success').addClass('btn-danger')
          } else {
            btnHadir.text('Hadir')
            btnHadir.removeClass('btn-danger').addClass('btn-success')
          }

        }
      });
    }

  })
</script>
@endsection
