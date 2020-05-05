 @extends('index')

 @section('pageTittle','Master Mata Pelajaran')
 @section('webTittle','Mata Pelajaran')

 @section('content')


<div class="row">
    <!-- ============================================================== -->

    <!-- ============================================================== -->

                  <!-- recent orders  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Mata Pelajaran</h5>
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<a href="#" class="btn btn-success float-right m-3 btn-add" data-toggle="modal" data-target="#addMataPelajaran"> Tambah Mata Pelajaran </a>
					</div>
				</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Mata Pelajaran</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php($i=1)
                          @foreach($dataMapel as $data)
                            <tr>
                                <td class="text-center">{{$i++}}</td>
                                <td class="text-center">{{$data->mapel}}</td>
                                <td class="text-center">{{$data->kategori}}</td>
                                <td class="text-center">
                                  <button type="button" data-toggle="modal" data-target="#addMataPelajaran" data-id="{{$data->id_mapel}}" class="btn btn-success btn-rounded btn-xs btn-edit"name="button">
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
<div class="modal fade" id="addMataPelajaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Tambah Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/tambahMapel" method="post" id="tambahMapel">
          @csrf
          <input type="hidden" name="id_mapel" value="">
    			<div class="form-group">
    				<label>Nama Mata Pelajaran</label>
    				<input type="text" name="mapel" class="form-control" placeholder="Nama Mata Pelajaran">
    			</div>
          <div class="form-group">
    				<label>Kategori</label>
    				<select class="form-control" name="kategori">
              <option value="UMUM">Umum</option>
              <option value="IPA">IPA</option>
              <option value="IPS">IPS</option>
            </select>
    			</div>
    		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="$('#tambahMapel').submit()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('.btn-edit').click(function(){
    $.get('/mataPelajaran/getDetail?id_mapel='+$(this).data('id'),function(data){
      console.log(data);
      $('#modal-title').text("Edit Mata Pelajaran")
      $('#tambahMapel').attr('action','/editMapel')
      $('input[name="id_mapel"]').val(data.id_mapel)
      $('input[name="mapel"]').val(data.mapel)
      $('select[name="kategori"]').val(data.kategori)
    })
  })
  $('.btn-add').click(function(){
    $('#tambahMapel')[0].reset()
    $('#modal-title').text("Tambah Mata Pelajaran")
    $('#tambahMapel').attr('action','/tambahMapel')
  })
</script>
@endsection
