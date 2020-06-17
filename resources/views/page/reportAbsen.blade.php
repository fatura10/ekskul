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
               <div class="col-sm-12">
                 <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link active btn btn-secondary btn-rounded" data-toggle="tab" href="#siswa">Siswa</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link btn btn-secondary btn-rounded" data-toggle="tab" href="#bulanan">Bulanan</a>
                  </li>
                </ul>
               </div>
             </div>
           </br>
             <div class="row">
               <div class="col-sm-12">
                 <div class="tab-content">
                    <div id="siswa" class="tab-pane fade in active">
                      <div class="table-responsive">
                          <table class="table">
                              <thead class="bg-light">
                                  <tr>
                                      <th class="text-center">#</th>
                                      <th class="text-center">Nama Ekskul</th>
                                      <th class="text-center">Tanggal Latihan</th>
                                      <th class="text-center">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php($i=1)
                                @foreach($dataEkskul as $data)
                                  <tr>
                                    <td class="text-center">{{($i++)}}</td>
                                    <td class="text-center">{{$data->nama}}</td>
                                    <td class="text-center">{{$data->hari}}, {{$data->tglLatihan}} - {{$data->starting_hour}} s.d {{$data->finishing_hour}}</td>
                                    <td class="text-center">
                                      <a href="/report/absen/siswa?id_jad={{$data->id_jadwal}}&id_ekskul={{$data->id_ekskul}}&tgl_latihan={{$data->tglLatihan2}}" class="btn btn-success">View</a>
                                    </td>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div id="bulanan" class="tab-pane fade">
                      <h3>Menu 1</h3>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                  </div>
                </div>
               </div>

            </div>

           </div>
       </div>
   </div>
   <!-- ============================================================== -->
   <!-- end recent orders  -->


</div>
@endsection
