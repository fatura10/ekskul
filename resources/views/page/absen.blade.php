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
                            <td class="text-center">
                              <a href="#" data-idsiswa="{{$data->id}}" data-idjadwal="{{$dataEkskul->id_jadwal}}" data-idguru="{{$id_pel}}" class="btn btn-success">Hadir</a>
                            </td>
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
@endsection
