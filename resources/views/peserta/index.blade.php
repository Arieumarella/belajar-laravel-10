@extends('.baseTamplate')

@section('content')

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

@endsection