@extends('layout.template')
   @section('konten')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
              <a href='{{url('mahasiswa/create')}}' class="btn btn-primary">+ Tambah Data</a>
            </div>
      
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Hobi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem() ?>
                        @foreach ($data as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->hobi }}</td>
                            <td>
                                <a href='{{url('mahasiswa/' .$item->nim.' /edit')}}' class="btn btn-warning btn-sm">Edit</a>
                                <form onsubmit="return confirm('Yakin akan menghapus data?')" class='d-inline' action="{{ url('mahasiswa/'.$item->nim) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                     <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>  
                        <?php $i++?>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
      </div>
   @endsection
   
