 @extends('index')

 @section('pageTittle','Detail Siswa')
 @section('webTittle','Siswa')

 @section('content')

<div class="row">
    <!-- ============================================================== -->

    <!-- ============================================================== -->

                  <!-- recent orders  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Detail Siswa</h5>
            <div class="card-body">
              <form method="post" action="/updateSiswa" id="updateSiswa">
                    @csrf
                    <input type="hidden" name="id" value="{{$dataSiswa->id}}">
                    <div class="form-group">
              				<label>NIS</label>
              				<input type="number" name="nis" class="form-control siswa" readonly placeholder="NIS" value="{{$dataSiswa->nis}}">
              			</div>
                    <div class="row">
              				<div class="form-group col-sm-6">
              					<label>NIPD</label>
                        <input type="number" name="nipd" class="form-control siswa" readonly placeholder="NIPD" value="{{$dataSiswa->nipd}}">
              				</div>
              				<div class="form-group  col-sm-6">
              					<label>NISN</label>
              					<input type="number" name="nisn" class="form-control siswa" readonly placeholder="NISN" value="{{$dataSiswa->nisn}}">
              				</div>
              			</div>
                    <div class="row">
              				<div class="form-group col-sm-6">
              					<label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control siswa" readonly placeholder="Nama Siswa" value="{{$dataSiswa->nama_siswa}}">
              				</div>
              				<div class="form-group  col-sm-6">
              					<label>Jenis Kelamin</label>
              					<select class="form-control siswa" disabled name="jns_kel">
                          <option value="">--Pilih Jenis Kelamin--</option>
                          <option value="L" {{($dataSiswa->jns_kel=="L"?"selected":"")}}>L</option>
                          <option value="P" {{($dataSiswa->jns_kel=="P"?"selected":"")}}>P</option>
                        </select>
              				</div>
              			</div>
                    <div class="row">
              				<div class="form-group col-sm-6">
              					<label>Kelas</label>
                        <select class="form-control siswa" disabled name="id_kelas">
                          <option value="">--Pilih Kelas--</option>
                          @foreach($dataKelas as $data)
                          <option value="{{$data->id_kelas}}" {{($dataSiswa->id_kelas==$data->id_kelas?"selected":"")}}>{{$data->nama}}</option>
                          @endforeach
                        </select>
              				</div>
              				<div class="form-group  col-sm-6">
              					<label>Jurusan</label>
              					<select class="form-control siswa" disabled name="konsentrasi">
                          <option value="">--Pilih Jurusan--</option>
                          <option value="IPA" {{($dataSiswa->konsentrasi=="IPA"?"selected":"")}}>IPA</option>
                          <option value="IPS" {{($dataSiswa->konsentrasi=="IPS"?"selected":"")}}>IPS</option>
                        </select>
              				</div>
              			</div>
                    <div class="row">
              				<div class="form-group col-sm-6">
              					<label>Tempat Lahir</label>
                        <input type="text" class="form-control siswa" name="tempat_lahir" readonly value="{{$dataSiswa->tempat_lahir}}">
              				</div>
              				<div class="form-group  col-sm-6">
              					<label>Tanggal Lahir</label>
              					<input type="date" class="form-control siswa" name="tgl_lahir" readonly value="{{$dataSiswa->tgl_lahir}}">
              				</div>
              			</div>
              			<div class="row">
              				<div class="form-group col-sm-6">
              					<label>Provinsi</label>
              					<select class="form-control siswa" readonly name="id_provinsi">
              						<option>-- Pilih Provinsi --</option>
                          @foreach($dataProvinsi as $data)
                          <option value="{{$data->id_provinsi}}" {{($dataSiswa->id_provinsi==$data->id_provinsi?"selected":"")}}>{{$data->nama}}</option>
                          @endforeach
              					</select>
              				</div>
              				<div class="form-group  col-sm-6" >
              					<label>Kota</label>
              					<select class="form-control siswa" name="id_kota" disabled>
              						<option>-- Pilih Kota --</option>
                          @foreach($dataKota as $data)
                            <option value="{{$data->id_kota}}" {{($dataSiswa->id_kota==$data->id_kota?"selected":"")}}>{{$data->nama}}</option>
                          @endforeach
              					</select>
              				</div>
              			</div>
              			<div class="form-group">
              				<label>Alamat</label>
              				<textarea class="form-control siswa textarea" readonly name="alamat">{{$dataSiswa->alamat}}</textarea>
              			</div>
              			<div class="form-group">
              				<label>Kode Pos</label>
              				<input type="number" name="kode_pos" class="form-control siswa" readonly placeholder="Kode Pos" value="{{$dataSiswa->kode_pos}}">
              			</div>
                    <a href="#" class="btn btn-success action-btn" data-id="siswa">Edit</a>
                    <a href="#" class="btn btn-success cancel-btn" data-id="siswaCancel" style="display:none;">Cancel</a>
              		</form>
                    <hr>

                    <label>Data Orang Tua</label>
                    <form class="" action="updateOrtu" method="post" id="updateOrtu">
                      @csrf
                      <input type="hidden" name="id_siswa" value="{{$dataSiswa->id}}">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                    				<label>Nama Ayah </label>
                    				<input type="text" name="nama_ortu[0]" class="form-control ortu" readonly value="{{isset($dataOrtu[0])?$dataOrtu[0]->nama:""}}" placeholder="Nama Ayah">
                    			</div>
                          <div class="row">
                    				<div class="form-group col-sm-6">
                    					<label>Tempat Lahir</label>
                              <input type="text" class="form-control ortu" name="tempat_lahir_ortu[0]" value="{{isset($dataOrtu[0])?$dataOrtu[0]->tempat_lahir:""}}" readonly placeholder="Tempat Lahir">
                    				</div>
                    				<div class="form-group  col-sm-6">
                    					<label>Tanggal Lahir</label>
                    					<input type="date" class="form-control ortu ortu" name="tgl_lahir_ortu[0]" value="{{isset($dataOrtu[0])?$dataOrtu[0]->tgl_lahir:""}}" readonly >
                    				</div>
                    			</div>
                          <div class="row">
                    				<div class="form-group col-sm-6">
                    					<label>Provinsi</label>
                              <select class="form-control ortu" disabled name="id_provinsi_ortu[0]">
                    						<option>-- Pilih Provinsi --</option>
                                @foreach($dataProvinsi as $data)
                                <option value="{{$data->id_provinsi}}" {{isset($dataOrtu[0])?($dataOrtu[0]->id_provinsi==$data->id_provinsi?"selected":""):""}}>{{$data->nama}}</option>
                                @endforeach
                    					</select>
                    				</div>
                    				<div class="form-group  col-sm-6">
                    					<label>Kota</label>
                    					<select class="form-control ortu" name="id_kota_ortu[0]" disabled>
                                <option value="">-- Pilih Kota --</option>
                                @if(isset($dataOrtu))
                                  @foreach($dataKota as $data)
                                    <option value="{{$data->id_kota}}" {{isset($dataOrtu[0])?($dataOrtu[0]->id_kota==$data->id_kota?"selected":""):""}}>{{$data->nama}}</option>
                                  @endforeach
                                @endif
                    					</select>
                    				</div>
                    			</div>
                    			<div class="form-group">
                    				<label>Alamat</label>
                    				<textarea class="form-control ortu textarea" name="alamat_ortu[0]" readonly>{{isset($dataOrtu[0])?$dataOrtu[0]->alamat:""}}</textarea>
                    			</div>
                    			<div class="form-group">
                    				<label>Kode Pos</label>
                    				<input type="number" readonly class="form-control ortu" name="kode_pos_ortu[0]" value="{{isset($dataOrtu[0])?$dataOrtu[0]->kode_pos:""}}" placeholder="Kode Pos">
                    			</div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                    				<label>Nama Ibu</label>
                    				<input type="text" readonly class="form-control ortu" name="nama_ortu[1]" value="{{isset($dataOrtu[1])?$dataOrtu[1]->nama:""}}" placeholder="No Telepon">
                    			</div>
                          <div class="row">
                    				<div class="form-group col-sm-6">
                    					<label>Tempat Lahir</label>
                              <input type="text" class="form-control ortu" value="{{isset($dataOrtu[1])?$dataOrtu[1]->tempat_lahir:""}}" name="tempat_lahir_ortu[1]" readonly>
                    				</div>
                    				<div class="form-group  col-sm-6">
                    					<label>Tanggal Lahir</label>
                    					<input type="date" class="form-control ortu" value="{{isset($dataOrtu[1])?$dataOrtu[1]->tgl_lahir:""}}" name="tgl_lahir_ortu[1]" readonly>
                    				</div>
                    			</div>
                          <div class="row">
                    				<div class="form-group col-sm-6">
                    					<label>Provinsi</label>
                              <select class="form-control ortu" disabled name="id_provinsi_ortu[1]">
                    						<option>-- Pilih Provinsi --</option>
                                @foreach($dataProvinsi as $data)
                                <option value="{{$data->id_provinsi}}" {{isset($dataOrtu[1])?($dataOrtu[1]->id_provinsi==$data->id_provinsi?"selected":""):""}}>{{$data->nama}}</option>
                                @endforeach
                    					</select>
                    				</div>
                    				<div class="form-group  col-sm-6">
                    					<label>Kota</label>
                    					<select class="form-control ortu"  name="id_kota_ortu[1]" disabled>
                    						<option>-- Pilih Kota --</option>
                                @if(isset($dataOrtu))
                                  @foreach($dataKota as $data)
                                    <option value="{{$data->id_kota}}" {{isset($dataOrtu[1])?($dataOrtu[1]->id_kota==$data->id_kota?"selected":""):""}}>{{$data->nama}}</option>
                                  @endforeach
                                @endif
                    					</select>
                    				</div>
                    			</div>
                    			<div class="form-group">
                    				<label>Alamat</label>
                    				<textarea class="form-control ortu textarea" readonly name="alamat_ortu[1]">{{isset($dataOrtu[1])?$dataOrtu[1]->alamat:""}}</textarea>
                    			</div>
                    			<div class="form-group">
                    				<label>Kode Pos</label>
                    				<input type="number" name="kode_pos_ortu[1]" value="{{isset($dataOrtu[1])?$dataOrtu[1]->kode_pos:""}}" class="form-control ortu" placeholder="Kode Pos" readonly>
                    			</div>
                        </div>
                      </div>
                      <a href="#" class="btn btn-success action-btn" data-id="ortu">Edit</a>
                      <a href="#" class="btn btn-success cancel-btn" data-id="ortuCancel" style="display:none;">Cancel</a>
                    </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end recent orders  -->


</div>
<script type="text/javascript">
  $('.cancel-btn').click(function(e){
    e.preventDefault()
    if ($(this).data('id')=='siswaCancel') {
      $('.siswa').attr('disabled',true)
      $('.siswa').attr('readonly',true)
      $('a[data-id="siswa"]').text("Edit")
      $('a[data-id="siswa"]').removeClass('btn-info').addClass('btn-success');
    } else {
      $('.ortu').attr('disabled',true)
      $('.ortu').attr('readonly',true)
      $('a[data-id="ortu"]').text("Edit")
      $('a[data-id="ortu"]').removeClass('btn-info').addClass('btn-success');
    }
    $(this).hide()
  })
  $('.action-btn').click(function(e){
    e.preventDefault()
    if ($(this).text()=='Edit') {
      $(this).text('Simpan')
      $(this).removeClass('btn-success').addClass('btn-info');
      if ($(this).data('id')=='siswa') {
        $('.siswa').attr('disabled',false)
        $('.siswa').attr('readonly',false)
        $('a[data-id="siswaCancel"]').show()
      } else {
        $('.ortu').attr('disabled',false)
        $('.ortu').attr('readonly',false)
        $('a[data-id="ortuCancel"]').show()
      }

    }else {
      $(this).text('Edit')
      $(this).removeClass('btn-info').addClass('btn-success');
      if ($(this).data('id')=='siswa') {
        $('#updateSiswa').submit()
      } else {
        $('#updateOrtu').submit()
      }

    }
  })
</script>
@endsection
