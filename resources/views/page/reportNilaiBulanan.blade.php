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
            <h5 class="card-header">Report Ekskul Bulanan</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <h1 class="text-center">Nilai Ekstrakulikuler {{$dataEkskul->nama}} </h1>
                </div>
              </div>

                <form class="" action="/report/absen/bulanan" method="post">
                  @csrf
                  <input type="hidden" name="id_ekskul" value="{{$dataEkskul->id_ekskul}}">
                  <div class="row">
                    <div class="col-sm-4">
                      <select class="form-control" name="bulan">
                        <option value="">--Pilih Bulan--</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <select class="form-control" name="tahun">
                        <option value="">--Pilih Tahun--</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <button type="submit" class="btn btn-success col-12 btn-sm" name="button">Lihat</button>
                    </div>
                  </div>
                </form>

            </br>
              <div class="table-responsive">
                  <table class="table">
                      <thead class="bg-light">
                          <tr>
                              <th class="text-center" rowspan="2">#</th>
                              <th class="text-center" rowspan="2">Nama Siswa</th>
                              <th class="text-center" rowspan="2">Kelas</th>
                              <th class="text-center" colspan="{{(isset($dtLength)?$dtLength:0)}}">Tanggal</th>
                          </tr>

                          <tr>
                            @if(isset($dtLength))
                            @for($i=0;$i<$dtLength;$i++)
                             <th>{{($i+1)}}</th>
                            @endfor
                            @endif
                          </tr>
                      </thead>
                      <tbody>
                        @php($i=1)
                        @if(isset($dataReport))
                          @php($NdataReport = json_decode(json_encode($dataReport),true) )
                          @foreach($NdataReport as $data)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data['nama_siswa']}}</td>
                            <td>{{$data['nama']}}</td>
                            @for($i=0;$i<$dtLength;$i++)
                             <th>{{$data[($i+1)]==0?'':$data[($i+1)]}}</th>
                            @endfor
                          </tr>
                          @endforeach
                        @endif
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
