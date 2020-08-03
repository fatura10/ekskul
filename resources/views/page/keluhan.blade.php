 @extends('index')

 @section('pageTittle','Master Keluhan')
 @section('webTittle','Keluhan')

 @section('content')


<div class="row">
    <!-- ============================================================== -->

    <!-- ============================================================== -->

                  <!-- recent orders  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Keluhan</h5>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<a href="#" class="btn btn-success float-right m-3 btn-add" data-toggle="modal" data-target="#addKeluhan"> Tambah Keluhan </a>
					</div>
				</div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Keluhan</th>
                                <th class="text-center">Feedback</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php($i=1)
                          @foreach($dataKeluhan as $data)
                            <tr>
                              <td class="text-center">{{($i++)}}</td>
                              <td>{{$data->keluhan}}</td>
                              <td>{{$data->feedback}}</td>
                              <td>{{$data->status}}</td>
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
<div class="modal fade" id="addKeluhan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-tittle">Tambah Keluhan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/tambahKeluhan" id="tambahKeluhan">
          @csrf
          <div class="form-group">
    				<label>Keluhan</label>
    				<textarea name="keluhan" class="form-control" rows="8" cols="80"></textarea>
    			</div>

    		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="$('#tambahKeluhan').submit()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('.btn-detail').click(function(){
    $('#tambahKeluhan').attr('action','/editKeluhan')
    $('#modal-tittle').text('Edit Keluhan')
    $.get('/guru/getDetail?id_guru='+$(this).data('id'),function(data){
      console.log(data);
      var html="";
      var dataKeluhan = data.dataKeluhan
      //$('.removeOption').remove()
      $.each(data.dataKota,function(){
        html+="<option class='kotaOption' value='"+this.id_kota+"'>"+this.nama+"</option>"

      })
        $('select[name="id_kota"]').html(html).promise().done(function(){
          $('select[name="id_kota"]').val(dataKeluhan.id_kota)
        })


      $('input[name="id_guru"]').val(dataKeluhan.id_guru)
      $('input[name="nip"]').val(dataKeluhan.nip)
      $('input[name="nama_guru"]').val(dataKeluhan.nama_guru)
      $('input[name="email"]').val(dataKeluhan.email)
      $('select[name="jns_kel"]').val(dataKeluhan.jns_kel)
      $('input[name="telepon"]').val(dataKeluhan.telepon)
      $('input[name="tempat_lahir"]').val(dataKeluhan.tempat_lahir)
      $('input[name="tgl_lahir"]').val(dataKeluhan.tgl_lahir)
      $('select[name="id_provinsi"]').val(dataKeluhan.id_provinsi)

      $('select[name="agama"]').val(dataKeluhan.agama)
      $('textarea[name="alamat"]').val(dataKeluhan.alamat)
      $('input[name="kode_pos"]').val(dataKeluhan.kode_pos)
    })
  })

  $('.btn-add').click(function(){
    $('#tambahKeluhan').attr('action','/tambahKeluhan')
    $('#modal-tittle').text('Tambah Keluhan')
    $('#tambahKeluhan')[0].reset()

  })
</script>
@endsection
