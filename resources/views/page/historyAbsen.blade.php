 @extends('index')

 @section('pageTittle','Riwayat Absen')
 @section('webTittle','Riwayat Absen')

 @section('content')


<div class="row">
    <!-- ============================================================== -->

    <!-- ============================================================== -->

                  <!-- recent orders  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Jadwal Pelajaran</h5>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<a href="#" class="btn btn-success float-right m-3 btn-add" data-toggle="modal" data-target="#addJadwalPelajaran">
              <i class="fa fa-sliders-h"></i> Filter
            </a>
					</div>
				</div>
                <div class="table-responsive">
                  <table class="table">
                      <thead class="bg-light">
                          <tr>
                              <th rowspan="2" class="text-center">#</th>
                              <th rowspan="2" class="text-center">Nama Guru</th>
                              <th rowspan="2" class="text-center">Mata Pelajaran</th>
                              <th rowspan="2" class="text-center">Hari</th>
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
                              <td class="text-center">{{$data->nama_guru}}</td>
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
    <!-- ============================================================== -->
    <!-- end recent orders  -->


</div>

@endsection
