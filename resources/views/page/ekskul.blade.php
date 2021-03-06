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
					<div class="col-lg-12">
						<a href="#" class="btn btn-success float-right m-3 btn-add" data-toggle="modal" data-target="#addEkskul"> Tambah Ekskul </a>
					</div>
				</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Ekskul</th>
                                <th class="text-center">Alamat Sekretariat</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Tanggal Gabung</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php($i=1)
                          @foreach($dataEkskul as $data)
                            <tr>
                              <td>{{($i++)}}</td>
                              <td>{{$data->nama}}</td>
                              <td>{{$data->alamat}}</td>
                              <td>{{$data->telepon}}</td>
                              <td>{{$data->tgl_gabung}}</td>
                              <td class="text-center">
                                <a href="/detailEkskul?id_ekskul={{$data->id_ekskul}}" class="btn btn-success btn-xs btn-rounded"><i class="fa fa-user"></i></a>
                                <a href="/anggotaEkskul?id_ekskul={{$data->id_ekskul}}" class="btn btn-success btn-xs btn-rounded"><i class="fa fa-users"></i></a>
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
<div class="modal fade" id="addEkskul" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-tittle">Tambah Ekskul</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/tambahEkskul" id="tambahEkskul">
          @csrf
          <input type="hidden" name="id_ekskul" value="">
          <div class="form-group">
    				<label>Nama Ekskul</label>
    				<input type="text" name="nama" class="form-control" placeholder="Nama Ekstrakulikuler">
    			</div>
          <div class="form-group">
    				<label>Alamat Sekretariat</label>
    				<textarea name="alamat" class="form-control"></textarea>
    			</div>
          <div class="form-group">
    				<label>Nomor Telepon</label>
    				<input type="number" name="telepon" class="form-control" placeholder="Telepon">
    			</div>
          <div class="form-group">
    				<label>Tanggal Bergabung</label>
    				<input type="date" name="tgl_gabung" class="form-control" placeholder="Tanggal Gabung">
    			</div>
    		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="$('#tambahEkskul').submit()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('.btn-detail').click(function(){
    $('#tambahEkskul').attr('action','/editEkskul')
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
    $('#tambahEkskul').attr('action','/tambahEkskul')
    $('#modal-tittle').text('Tambah Ekskul')
    $('#tambahEkskul')[0].reset()

  })
</script>
@endsection
