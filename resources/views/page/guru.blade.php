 @extends('index')

 @section('pageTittle','Master Guru')
 @section('webTittle','Guru')

 @section('content')


<div class="row">
    <!-- ============================================================== -->

    <!-- ============================================================== -->

                  <!-- recent orders  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Guru</h5>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<a href="#" class="btn btn-success float-right m-3 btn-add" data-toggle="modal" data-target="#addGuru"> Tambah Guru </a>
					</div>
				</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Guru</th>
                                <th class="text-center">Tempat/Tanggal Lahir</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">No Telepon</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php($i=1)
                          @foreach($dataGuru as $data)
                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td class="text-center">{{$data->nama_guru}}</td>
                                <td class="text-center">{{$data->tempat_lahir}}, {{date_format(date_create($data->tgl_lahir),'d M Y')}}</td>
                                <td class="text-center">{{$data->alamat}}, {{ucwords(strtolower($data->kota_nm))}}, {{ucwords(strtolower($data->prov_nm))}}, {{$data->kode_pos}}</td>
                                <td class="text-center">{{$data->telepon}}</td>
                                <td class="text-center">
                                  <button type="button" data-id="{{$data->id_guru}}" data-toggle="modal" data-target="#addGuru" class="btn btn-primary btn-rounded btn-xs btn-detail"name="button">
                                    <i class="fa fa-list-alt"></i>
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
<div class="modal fade" id="addGuru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-tittle">Tambah Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/tambahGuru" id="tambahGuru">
          @csrf
          <input type="hidden" name="id_guru" value="">
          <div class="form-group">
    				<label>NIP</label>
    				<input type="text" name="nip" class="form-control" placeholder="NIP">
    			</div>
    			<div class="form-group">
    				<label>Nama Guru</label>
    				<input type="text" name="nama_guru" class="form-control" placeholder="Nama Guru">
    			</div>
          <div class="form-group">
    				<label>Email</label>
    				<input type="email" name="email" class="form-control" placeholder="Email">
    			</div>
          <div class="row">
    				<div class="form-group col-sm-6">
    					<label>Jenis Kelamin</label>
    					<select class="form-control" name="jns_kel">
                <option>-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
    						<option value="P">Perempuan</option>
    					</select>
    				</div>
    				<div class="form-group  col-sm-6">
    					<label>Nomor Telepon</label>
    					<input type="text" class="form-control" name="telepon" placeholder="Nomor Telepon">
    				</div>
    			</div>
          <div class="row">
    				<div class="form-group col-sm-6">
    					<label>Tempat Lahir</label>
              <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" >
    				</div>
    				<div class="form-group  col-sm-6">
    					<label>Tanggal Lahir</label>
    					<input type="date" class="form-control" name="tgl_lahir" value="">
    				</div>
    			</div>
    			<div class="row">
    				<div class="form-group col-sm-6">
    					<label>Provinsi</label>
    					<select class="form-control" name="id_provinsi">
                <option>-- Pilih Provinsi --</option>
                @foreach($dataProvinsi as $data)
                <option value="{{$data->id_provinsi}}">{{$data->nama}}</option>
                @endforeach
    					</select>
    				</div>
    				<div class="form-group  col-sm-6">
    					<label>Kota</label>
    					<select class="form-control" name="id_kota">
    						<option>-- Pilih Kota --</option>
                <option value="1">Kota Tangerang</option>
    					</select>
    				</div>
    			</div>
          <div class="row">
    				<div class="form-group col-sm-6">
    					<label>Agama</label>
              <select class="form-control" name="agama">
    						<option>-- Pilih Agama --</option>
                <option value="1">Islam</option>
    					</select>
    				</div>
    				<div class="form-group  col-sm-6">
    					<label>Foto</label>
    					<input type="file" class="form-control" name="foto" value="">
    				</div>
    			</div>
    			<div class="form-group">
    				<label>Alamat</label>
    				<textarea class="form-control" name="alamat"></textarea>
    			</div>
    			<div class="form-group">
    				<label>Kode Pos</label>
    				<input type="number" name="kode_pos" class="form-control" placeholder="Kode Pos">
    			</div>

    		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="$('#tambahGuru').submit()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('.btn-detail').click(function(){
    $('#tambahGuru').attr('action','/editGuru')
    $('#modal-tittle').text('Edit Guru')
    $.get('/guru/getDetail?id_guru='+$(this).data('id'),function(data){
      console.log(data);
      var html="";
      var dataGuru = data.dataGuru
      //$('.removeOption').remove()
      $.each(data.dataKota,function(){
        html+="<option class='kotaOption' value='"+this.id_kota+"'>"+this.nama+"</option>"

      })
        $('select[name="id_kota"]').html(html).promise().done(function(){
          $('select[name="id_kota"]').val(dataGuru.id_kota)
        })


      $('input[name="id_guru"]').val(dataGuru.id_guru)
      $('input[name="nip"]').val(dataGuru.nip)
      $('input[name="nama_guru"]').val(dataGuru.nama_guru)
      $('input[name="email"]').val(dataGuru.email)
      $('select[name="jns_kel"]').val(dataGuru.jns_kel)
      $('input[name="telepon"]').val(dataGuru.telepon)
      $('input[name="tempat_lahir"]').val(dataGuru.tempat_lahir)
      $('input[name="tgl_lahir"]').val(dataGuru.tgl_lahir)
      $('select[name="id_provinsi"]').val(dataGuru.id_provinsi)

      $('select[name="agama"]').val(dataGuru.agama)
      $('textarea[name="alamat"]').val(dataGuru.alamat)
      $('input[name="kode_pos"]').val(dataGuru.kode_pos)
    })
  })

  $('.btn-add').click(function(){
    $('#tambahGuru').attr('action','/tambahGuru')
    $('#modal-tittle').text('Tambah Guru')
    $('#tambahGuru')[0].reset()

  })
</script>
@endsection
