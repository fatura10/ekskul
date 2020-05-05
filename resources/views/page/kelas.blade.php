@extends('index')

@section('pageTittle','Master Jadwal Pelajaran')
@section('webTittle','Jadwal Pelajaran')

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
           <a href="#" class="btn btn-success float-right m-3 btn-add" data-toggle="modal" data-target="#addKelas"> Tambah Kelas </a>
         </div>
       </div>
               <div class="table-responsive">
                 <table class="table">
                     <thead class="bg-light">
                         <tr>
                             <th class=" text-center align-middle" rowspan="2">No</th>
                             <th class=" text-center align-middle" rowspan="2">Nama Kelas</th>
                             <th class=" text-center" rowspan="2">Kapasitas</th>
                             <th class=" text-center" colspan="5">Fasilitas</th>
                             <th class=" text-center align-middle" rowspan="2">Opsi</th>
                         </tr>
                         <tr>
                           <th class="text-center">Proyektor</th>
                           <th class="text-center">Papan Tulis</th>
                           <th class="text-center">Komputer</th>
                           <th class="text-center">Sound Sytem</th>
                           <th class="text-center">AC</th>
                         </tr>
                     </thead>
                     <tbody>
                       @php($i=1)
                       @foreach($dataKelas as $data)
                         <tr>
                             <td class="text-center">{{$i++}}</td>
                             <td class="text-center">{{$data->nama}}</td>
                             <td class="text-center">{{$data->kapasitas}} Orang</td>
                             <td class="text-center"><input type="checkbox" name="" value="" {{($data->proyektor=="on"?"checked":"")}} disabled> </td>
                             <td class="text-center"><input type="checkbox" name="" value="" {{($data->papan_tulis=="on"?"checked":"")}} disabled> </td>
                             <td class="text-center"><input type="checkbox" name="" value="" {{($data->komputer=="on"?"checked":"")}} disabled> </td>
                             <td class="text-center"><input type="checkbox" name="" value="" {{($data->sound_system=="on"?"checked":"")}} disabled> </td>
                             <td class="text-center"><input type="checkbox" name="" value="" {{($data->ac=="on"?"checked":"")}} disabled> </td>
                             <td class="text-center">
                               <button data-id="{{$data->id_kelas}}" type="button"  data-toggle="modal" data-target="#addKelas" class="btn btn-success btn-rounded btn-xs btn-edit" name="button">
                               <i class="fa fa-pencil"></i>
                             </button>
                             </td>
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

<!-- Modal -->
<div class="modal fade" id="addKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="modal-title">Tambah Jadwal Pelajaran</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <form method="post" action="/tambahKelas" id="tambahKelas">
         <input type="hidden" name="id_kelas" value="">
         @csrf
         <div class="form-group">
           <div class="row">
             <div class="form-group  col-sm-6">
               <label>Jenjang</label>
               <select class="form-control" name="jenjang">
                 <option value="">-- Pilih Kelas --</option>
                 <option value="VII">VII</option>
                 <option value="VIII">VIII</option>
                 <option value="IX">IX</option>
               </select>
             </div>
             <div class="form-group  col-sm-6">
               <label>Kelas</label>
               <select class="form-control" name="kelas">
                 <option value="">-- Pilih Kelas --</option>
                 <option value="A">A</option>
                 <option value="B">B</option>
                 <option value="C">C</option>
                 <option value="D">D</option>
                 <option value="E">E</option>
                 <option value="F">F</option>
                 <option value="G">G</option>
                 <option value="H">H</option>
                 <option value="I">I</option>
               </select>
             </div>
           </div>
         </div>

         <div class="form-group">
           <label>Kapasitas</label>
           <input type="number" name="kapasitas" class="form-control" name="kapasitas" value="" placeholder="Kapasitas">
         </div>
         <div class="form-group">
           <label>Fasilitas</label>
           <label class="custom-control custom-checkbox ">
               <input type="checkbox" name="proyektor" class="custom-control-input">
               <span class="custom-control-label">LCD Proyektor</span>
           </label>
           <label class="custom-control custom-checkbox ">
               <input type="checkbox" name="papan_tulis" class="custom-control-input">
               <span class="custom-control-label">Papan Tulis</span>
           </label>
           <label class="custom-control custom-checkbox ">
               <input type="checkbox" name="komputer" class="custom-control-input">
               <span class="custom-control-label">Komputer</span>
           </label>
           <label class="custom-control custom-checkbox ">
               <input type="checkbox" name="sound_system" class="custom-control-input">
               <span class="custom-control-label">Sound System</span>
           </label>
           <label class="custom-control custom-checkbox ">
               <input type="checkbox" name="ac" class="custom-control-input">
               <span class="custom-control-label">AC</span>
           </label>
         </div>
       </form>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <button type="button" class="btn btn-success" onclick="$('#tambahKelas').submit()">Save changes</button>
     </div>
   </div>
 </div>
</div>

<script type="text/javascript">
 $('.btn-edit').click(function(){
   $.get('/kelas/getDetail?id_kelas='+$(this).data('id'),function(data){
     console.log(data);
     var split = data.nama.split("-");
     $('#tambahKelas').attr('action','/editKelas')
     $('#modal-title').text('Edit Jadwal Pelajaran')
     $('input[name="id_kelas"]').val(data.id_kelas)
     $('input[name="kapasitas"]').val(data.kapasitas)
     $('select[name="jenjang"]').val(split[0])
     $('select[name="kelas"]').val(split[1])
     $('input[name="proyektor"]').prop('checked',(data.proyektor=='on'?true:false))
     $('input[name="papan_tulis"]').prop('checked',(data.papan_tulis=='on'?true:false))
     $('input[name="sound_system"]').prop('checked',(data.sound_system=='on'?true:false))
     $('input[name="ac"]').prop('checked',(data.ac=='on'?true:false))
   })
 })
 $('.btn-add').click(function(){
   $('#tambahKelas').attr('action','/tambahKelas')
   $('#modal-title').text('Tambah Jadwal Pelajaran')
   $('#tambahKelas')[0].reset()
 })
</script>
@endsection
