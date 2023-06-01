<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Belajar laravel 10</title>
  </head>
  <body>
    <!-- Nav Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Web Belajar Laravel 10</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </div>
                </div>
            </div>
        </nav>
    <!-- End Nav bar -->
   
        <div class="row m-4">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body text-center ">
                        <h3 class="mb-2">Data Peserta</h3>

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
                            <th scope="col">Alamat</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @php 
                            
                            $no=1

                            @endphp

                            @forelse ($dataPeserta as $value)
                            <tr>
                                <td scope="row">{{ $no }}</th>
                                <td>{{ $value->nama }}</td>
                                <td>{{ $value->nomor_telefon }}</td>
                                <td>{{ $value->alamat}}</td>
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
                            {{  $dataPeserta->links(); }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('peserta.store') }}" method="POST">
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
              <form action="{{ route('peserta.update', '2') }}" id="formEdit" method="PUT">
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
  </body>
</html>