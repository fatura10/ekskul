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
        <h5 class="card-header">Detail Ekskul</h5>
        <div class="card-body">
  				<div class="row">
  					<div class="col-lg-12">
  						<table class="table">
                <thead>
                  <tr>
                    <th>Nama : </th>
                    <th>{{$dataEkskul->nama}}</th>
                    <th>Nomor Telepon : </th>
                    <th>{{$dataEkskul->telepon}}</th>
                  </tr>
                  <tr>
                    <th>Tanggal Gabung : </th>
                    <th>{{$dataEkskul->tgl_gabung}}</th>
                    <th>Alamat : </th>
                    <th>{{$dataEkskul->alamat}}</th>
                  </tr>
                </thead>
              </table>
  					</div>
  				</div>
          <div class="row">
            <div class="col-lg-6">
              <a href="#" class="btn btn-success" data-target="#addPelatih" data-toggle="modal">Tambah Pelatih</a>
            </div>
            <div class="col-lg-6">
              <a href="#" class="btn btn-success">Tambah Jadwal</a>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pelatih</th>
                  </tr>
                </thead>
                <tbody>
                  @php($i=1)
                  @foreach($dataPelatih as $data)
                  <tr>
                    <td>{{($i++)}}</td>
                    <td>{{$data->nama_guru}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="col-lg-6">
              <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Jam</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Kamis</td>
                    <td>14:00 s.d Selesai</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- end recent orders  -->


</div>

<!-- Modal -->
<div class="modal fade" id="addPelatih" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-tittle">Tambah Pelatih</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/tambahPelatih" id="tambahPelatih">
          @csrf
          <input type="hidden" name="id_ekskul" value="{{$dataEkskul->id_ekskul}}">
          <div class="form-group">
    				<label>Nama Pelatih</label>
            <input type="text" name="liveSearch" class="form-control" placeholder="Nama Ekstrakulikuler">
            <input type="hidden" name="id_guru" class="form-control" placeholder="Nama Ekstrakulikuler">
            <div id="liveSearch" class="liveSearch" style="width : 100%;">
            </div>
    			</div>
    		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="$('#tambahPelatih').submit()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('input[name="liveSearch"]').keydown(function(){
    $.get('/guru/getList?name='+$(this).val(),function(rs){
      console.log(rs);
      html = "";
      $.each(rs,function(i,e){
        html += "<a href='#' style='text-decoration : none' class='selected-name' data-id='"+e.id_guru+"'>"+(i+1)+". "+e.nama_guru+"</a></br>"
      })
      $('#liveSearch').html(html).promise().done(function(){
        $('#liveSearch').css({display : "block"})
        $('.selected-name').click(function(){
          $('input[name="id_guru"]').val($(this).data('id'))
          $('input[name="liveSearch"]').val($(this).text().split('.')[1])
          $('#liveSearch').css({display : "none"})
        })
      })
    })
  })
</script>
@endsection
