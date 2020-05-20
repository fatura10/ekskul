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
            <h5 class="card-header">Ekskul</h5>
            <div class="card-body">
				<div class="row">
				</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Ekskul</th>
                                <th class="text-center">Jadwal Latihan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php($i=1)
                          @foreach($dataEkskul as $data)
                            <tr>
                              <td class="text-center">{{($i++)}}</td>
                              <td class="text-center">{{$data->nama}}</td>
                              <td class="text-center">{{$data->hari}}, {{$data->starting_hour}} s.d {{$data->finishing_hour}}</td>
                              <td class="text-center">
                                <a href="/{{$status=='absen'?'absenEkskul':'nilaiEkskul'}}?id_ekskul={{$data->id_ekskul}}" class="btn btn-success">{{$status=='absen'?'Absen':'Nilai'}}</a>
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
