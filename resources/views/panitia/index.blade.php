@extends('.baseTamplate')

@section('content')

<div class="card">
  <div class="card-body text-center ">
      <h3 class="mb-2">Data Panitia</h3>

    @if (count($errors) > 0)
      <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
        @foreach ($errors->all() as $error)
          {{ $error }} <br>
        @endforeach
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('ok') != null)
      <div class="alert alert-success alert-dismissible fade show text-start" role="alert">
        {{ session('ok') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('no') != null)
      <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
        {{ session('no') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

      <div class="text-end mt-2">
          <button class="btn btn-primary" onclick="showAddModal()">Tambah Data</button>
      </div>
      <table class="table mt-4 table-striped table-bordered ">
      <thead>
          <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Kontak</th>
          <th scope="col">Email</th>
          <th scope="col">Alamat</th>
          <th scope="col">Aksi</th>
          </tr>
      </thead>
      <tbody>
          
          @php 
          
          $no=1

          @endphp

          @forelse ($data as $value)
          <tr>
              <td scope="row">{{ $no }}</th>
              <td>{{ $value->nama }}</td>
              <td>{{ $value->nomor_telepon }}</td>
              <td>{{ $value->email}}</td>
              <td>{{ $value->alamat }}</td>
              <td>
                <button class="btn btn-sm btn-warning" onclick="showModalEdit('{{ $value->id }}')"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-sm btn-danger" onclick="deleteData('{{ $value->id }}')"><i class="fa-solid fa-trash"></i></button>
              </td>
          </tr>
          <tr>
              @php 
          
              $no++

              @endphp

          @empty
          <tr>
              <td colspan="4">Data Kosong</th>
          <tr>   
          @endforelse
          
      </tbody>
      </table>
      <div class="mt-2 text-end">
          {{  $data->links(); }}
      </div>
  </div>
</div>


<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('panitia.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Nama</label>
              <input type="text" class="form-control" name="nama" id="nama" placeholder="input nama" required>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Telepon</label>
                <input type="text" class="form-control" name="nomor_telefon" id="nomor_telefon" placeholder="input telepon" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="input Email" required>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Alamat</label>
              <textarea class="form-control" name="alamat" id="alamat" placeholder="Input Alamat"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  
  
  {{-- Edit modal --}}
  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal Edit Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="formEdit" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Nama</label>
              <input type="text" class="form-control" name="nama" id="namaEdit" placeholder="input nama" required>
              <input type="hidden" class="form-control" name="idEdit" id="idEdit">
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Telepon</label>
                <input type="text" class="form-control" name="nomor_telefon" id="nomor_telefonEdit" placeholder="input telepon" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
              </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Alamat</label>
              <textarea class="form-control" name="alamat" id="alamatEdit" placeholder="Input Alamat"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  {{-- End Edit Modal --}}


<script>
    $( document ).ready(function() {
  showAddModal = function () {
      $('#modalTambah').modal('show');
  }

  showModalEdit = function (id){

    let token   = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "/peserta/"+id+"/edit",
        type: "GET",
        data: {
                  "_token": token
        },
        success:function(res){    

          $('#namaEdit').val(res.data.nama);
          $('#nomor_telefonEdit').val(res.data.nomor_telefon);
          $('#alamatEdit').val(res.data.alamat);
          $('#idEdit').val(res.data.id);

          var form = $('#formEdit');
          form.attr('action', 'peserta/'+id);

          $('#modalEdit').modal('show');

        }
    });

  }


  deleteData = function (id){

    let token   = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: "/peserta/"+id,
        type: "DELETE",
        data: {
                  "_token": token
        },
        success:function(response){ 
          location.reload();
        }
    });

  }


});
</script>

@endsection