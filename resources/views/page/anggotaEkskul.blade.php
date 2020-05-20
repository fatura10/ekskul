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
                          @php($i=1)
                          @foreach($dataAnggota as $data)
                          <tr>
                            <th class="text-center">{{$i++}}</th>
                            <th class="text-center">{{$data->nama_siswa}}</th>
                            <th class="text-center">{{$data->nama}}</th>
                            <th class="text-center">{{$data->tempat_lahir}}</th>
                            <th class="text-center">{{$data->tgl_lahir}}</th>
                            <th class="text-center">{{$data->alamat}}</th>
                            <th class="text-center">Action</th>
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
        <form method="post" action="/tambahAnggota" id="tambahAnggota">
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
$('input[name="liveSearch"]').keydown(function(){
  $.get('/siswa/getList?nama='+$(this).val()+'&id_kelas='+$('select[name="kelas"]').val()+'&id_ekskul='+$('input[name="id_ekskul"]').val(),function(rs){
    console.log(rs);
    html = "";
    $.each(rs,function(i,e){
      html += "<a href='#' style='text-decoration : none' class='selected-name' data-id='"+e.id+"'>"+(i+1)+". "+e.nama_siswa+"</a></br>"
    })
    $('#liveSearch').html(html).promise().done(function(){
      $('#liveSearch').css({display : "block"})
      $('.selected-name').click(function(){
        $('input[name="id_siswa"]').val($(this).data('id'))
        $('input[name="liveSearch"]').val($(this).text().split('.')[1])
        $('#liveSearch').css({display : "none"})
      })
    })
  })
})
</script>
@endsection
