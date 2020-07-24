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
            <h5 class="card-header">Nilai Ekskul</h5>
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
                <form id="formNilai" action="/nilai/save" method="post">
                  @csrf
                  <input type="hidden" name="id_ekskul" value="{{$dataEkskul->id_ekskul}}">
                  <table class="table">
                      <thead class="bg-light">
                          <tr>
                              <th class="text-center">#</th>
                              <th class="text-center">Nama Siswa</th>
                              <th class="text-center">Kelas</th>
                              <th class="text-center" style="min-width : 1vw;">Nilai</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php($i=1)
                        @php($z=0)
                        @foreach($dataAbsen as $data)
                          <tr>
                            <td class="text-center">{{($i++)}}</td>
                            <td class="text-center">{{$data->nama_siswa}}</td>
                            <td class="text-center">{{$data->nama}}</td>
                            <td class="text-center">
                              <input type="hidden" name="id_siswa[{{($z)}}]" value="{{$data->id}}">
                              <input type="text" class="form-control" name="nilai[{{($z++)}}]" style="width : 3vw;margin : 0 auto;" value="">
                            </td>
                        @endforeach
                      </tbody>
                  </table>
                  <button type="submit" class="btn btn-primary btn-simpan" name="button">Simpan</button>
                  <button type="reset" class="btn btn-default" name="button">Clear</button>
                </form>

              </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end recent orders  -->


</div>
<script type="text/javascript">
  $('.btn-simpan').click(function(){
    $('#formNilai').submit()
  })
</script>
@endsection
