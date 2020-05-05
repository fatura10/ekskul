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
						<a href="#" class="btn btn-success float-right m-3 btn-add" data-toggle="modal" data-target="#addJadwalPelajaran"> Tambah Jadwal Pelajaran </a>
					</div>
				</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Jam</th>
                                <th class="text-center">Mata Pelajaran</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Guru</th>
                                <th class="text-center">Opsi</th>
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
                                <td class="text-center">{{$data->mapel}}</td>
                                <td class="text-center">{{$data->nama}}</td>
                                <td class="text-center">{{$data->nama_guru}}</td>
                                <td class="text-center">
                                  <button type="button" data-id="{{$data->id_jadwal}}" data-toggle="modal" data-target="#addJadwalPelajaran" class="btn btn-success btn-rounded btn-xs  btn-edit"name="button">
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
<div class="modal fade" id="addJadwalPelajaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Tambah Jadwal Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/tambahJapel" method="post" id="tambahJapel">
          @csrf
          <input type="hidden" name="id_jadwal" value="">
          <div class="row">
            <div class="form-group col-sm-6">
      				<label>Hari</label>
      				<select class="form-control" name="hari">
                <option value="">--Pilih Hari--</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
              </select>
      			</div>
            <div class="form-group col-sm-6">
      				<label>Jam</label>
      				<select class="form-control" name="jam">
                <option value="">--Pilih Jam--</option>
                <option value="0">08:00 s.d 09:00</option>
                <option value="1">09:00 s.d 10:00</option>
                <option value="2">10:00 s.d 11:00</option>
                <option value="3">11:00 s.d 12:00</option>
                <option value="4">13:00 s.d 14:00</option>
                <option value="5">14:00 s.d 15:00</option>
              </select>
      			</div>
          </div>
          <div class="row">
            <div class="form-group  col-sm-6">
    					<label>Kelas</label>
    					<select class="form-control" name="id_kelas">
    						<option>-- Pilih Kelas --</option>
                @foreach($dataKelas as $data)
                  <option value="{{$data->id_kelas}}|{{$data->nama}}">{{$data->nama}}</option>
                @endforeach
    					</select>
    				</div>
    				<div class="form-group col-sm-6">
    					<label>Mata Pelajaran</label>
    					<select class="form-control" name="id_mapel">
    						<option>-- Pilih Mata Pelajaran --</option>
                @foreach($dataMapel as $data)
                  <option value="{{$data->id_mapel}}">{{$data->mapel}}</option>
                @endforeach
    					</select>
    				</div>
    			</div>
          <div class="form-group">
            <label>Guru</label>
            <select class="form-control" name="id_guru">
              <option>-- Pilih Guru --</option>
              @foreach($dataGuru as $data)
                <option value="{{$data->id_guru}}">{{$data->nama_guru}}</option>
              @endforeach
            </select>
          </div>
    		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="$('#tambahJapel').submit()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('.btn-edit').click(function(){
    $.get('/jadwalPelajaran/getDetail?id_jadwal='+$(this).data('id'),function(data){
      console.log(data);
      $('#tambahJapel').attr('action','/editJapel')
      $('#modal-title').text('Edit Jadwal Pelajaran')
      $('input[name="id_jadwal"]').val(data.id_jadwal)
      $('select[name="hari"]').val(data.hari)
      $('select[name="jam"]').val(data.jam)
      $('select[name="id_kelas"]').val(data.id_kelas+"|"+data.nama)
      $('select[name="id_mapel"]').val(data.id_mapel)
      $('select[name="id_guru"]').val(data.id_guru)
    })
  })
  $('.btn-add').click(function(){
    $('#tambahJapel').attr('action','/tambahJapel')
    $('#modal-title').text('Tambah Jadwal Pelajaran')
    $('#tambahJapel')[0].reset()
  })
</script>
@endsection
