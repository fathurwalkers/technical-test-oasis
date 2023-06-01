@extends('layouts')

@section('main-content')
    <div class="container">

        <div class="row mt-4">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <button type="button" class="btn btn-success mr-2" onclick="location.href = '{{ route('index') }}';">
                    Kembali ke Index
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Pegawai
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('post-tambah-pegawai') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="container">

                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">Foto </label>
                                                    <input type="file" name="photo" accept=".jpg,.jpeg,.png">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Nama </label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="email">Email </label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label for="gender">Jenis Kelamin </label>
                                                <select class="form-control" name="gender" id="gender">
                                                    <option value="Pria">Pria</option>
                                                    <option value="Wanita">Wanita</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label for="hobby">Hobi </label>
                                                <select class="form-control" name="hobby" id="hobby">
                                                    <option value="Sepak Bola">Sepak Bola</option>
                                                    <option value="Voli">Voli</option>
                                                    <option value="Tenis Meja">Tenis Meja</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="nip">NIP </label>
                                                    <input type="text" class="form-control" id="nip"
                                                        name="nip">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row mt-4">
            <div class="col-sm-12 col-md-12 col-lg-12">
                @if (session('status'))
                    <div class="alert alert-primary">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-sm-12 col-md-12 col-lg-12 mt-4">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Hobby</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Kelola</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pegawai as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->hobby }}</td>
                                <td><img src="{{ asset('photo/' . $item->photo) }}" alt="" class="img img-fluid"
                                        width="100px" /></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_ubah{{ $item->id }}">Ubah</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus{{ $item->id }}">Hapus</button>
                                </td>
                            </tr>

                            {{-- MODAL UPDATE --}}
                            <div class="modal fade" id="modal_ubah{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('post-update-pegawai', $item->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="container">

                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <label for="name">Foto </label>
                                                                <input type="file" name="photo"
                                                                    accept=".jpg,.jpeg,.png" value="{{ $item->photo }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label for="name">Nama </label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name" value="{{ $item->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label for="email">Email </label>
                                                                <input type="email" class="form-control" id="email"
                                                                    name="email" value="{{ $item->email }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <label for="gender">Jenis Kelamin </label>
                                                            <select class="form-control" name="gender" id="gender" value="{{ $item->gender }}">
                                                                <option selected value="Pria">{{ $item->gender }}</option>
                                                                <option value="Pria">Pria</option>
                                                                <option value="Wanita">Wanita</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <label for="hobby">Hobi </label>
                                                            <select class="form-control" name="hobby" id="hobby" value="{{ $item->hobby }}">
                                                                <option selected value="Sepak Bola">{{ $item->hobby }}</option>
                                                                <option value="Sepak Bola">Sepak Bola</option>
                                                                <option value="Voli">Voli</option>
                                                                <option value="Tenis Meja">Tenis Meja</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <label for="nip">NIP </label>
                                                                <input type="text" class="form-control" id="nip"
                                                                    name="nip" value="{{ $item->nip }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- MODAL DELETE --}}
                            <div class="modal fade" id="modal_hapus{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('post-hapus-pegawai', $item->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="container">

                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            Apakah anda yakin ingin menghapus Data Pegawai ini?
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
