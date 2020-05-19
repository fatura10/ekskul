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
            <h5 class="card-header">Anggota Ekskul</h5>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<a href="#" class="btn btn-success float-right m-3 btn-add" data-toggle="modal" data-target="#addAnggota"> Tambah Anggota </a>
					</div>
				</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Anggota</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Tempat Lahir</th>
                                <th class="text-center">Tanggal Lahir</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

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
<div class="modal fade" id="addAnggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-tittle">Tambah Ekskul</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/tambahPelatih" id="tambahPelatih">
          @csrf
          <input type="hidden" name="id_ekskul" value="{{$dataEkskul->id_ekskul}}">
          <select class="form-control" name="kelas">
            <option value="">-Pilih Kelas-</option>
            @foreach($dataKelas as $data)
              <option value="{{$data->id_kelas}}">{{$data->nama}}</option>
            @endforeach
          </select>
          <div class="form-group">
    				<label>Nama Anggota</label>
            <input type="text" name="liveSearch" class="form-control" placeholder="Nama Ekstrakulikuler">
            <input type="hidden" name="id_siswa" class="form-control" placeholder="Nama Ekstrakulikuler">
            <div id="liveSearch" class="liveSearch" style="width : 100%;">
            </div>
    			</div>
    		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="$('#tambahAnggota').submit()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('.btn-detail').click(function(){
    $('#tambahAnggota').attr('action','/editEkskul')
    $('#modal-tittle').text('Edit Ekskul')
    $.get('/guru/getDetail?id_guru='+$(this).data('id'),function(data){
      console.log(data);
      var html="";
      var dataEkskul = data.dataEkskul
      //$('.removeOption').remove()
      $.each(data.dataKota,function(){
        html+="<option class='kotaOption' value='"+this.id_kota+"'>"+this.nama+"</option>"

      })
        $('select[name="id_kota"]').html(html).promise().done(function(){
          $('select[name="id_kota"]').val(dataEkskul.id_kota)
        })


      $('input[name="id_guru"]').val(dataEkskul.id_guru)
      $('input[name="nip"]').val(dataEkskul.nip)
      $('input[name="nama_guru"]').val(dataEkskul.nama_guru)
      $('input[name="email"]').val(dataEkskul.email)
      $('select[name="jns_kel"]').val(dataEkskul.jns_kel)
      $('input[name="telepon"]').val(dataEkskul.telepon)
      $('input[name="tempat_lahir"]').val(dataEkskul.tempat_lahir)
      $('input[name="tgl_lahir"]').val(dataEkskul.tgl_lahir)
      $('select[name="id_provinsi"]').val(dataEkskul.id_provinsi)

      $('select[name="agama"]').val(dataEkskul.agama)
      $('textarea[name="alamat"]').val(dataEkskul.alamat)
      $('input[name="kode_pos"]').val(dataEkskul.kode_pos)
    })
  })

  $('.btn-add').click(function(){
    $('#tambahAnggota').attr('action','/tambahAnggota')
    $('#modal-tittle').text('Tambah Ekskul')
    $('#tambahAnggota')[0].reset()

  })
</script>
@endsection
