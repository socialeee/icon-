@extends('layouts.app')
@section('title')
    Pelanggan
@endsection
@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{session('status')}}
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pelanggan</h6>
    </div>
    <div class="card-body">
        <!-- Button trigger modal -->
        @role('activator')
        <div class="float-right mb-2">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#createModal">Tambah Pelanggan</button>
        </div>
        @endrole
        <!-- Modal Tambah -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Menambah Pelanggan Baru</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pelanggan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Nomor SO</label>
                              <input type="text" name="nomor_so" class="form-control" required>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                              <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" required>
                              </div>
                              <label for="text" class="form-label">Status</label>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="AKTIF">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  Aktif
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" checked value="NONAKTIF">
                                <label class="form-check-label" for="flexRadioDefault2">
                                  Non Aktif
                                </label>
                              </div>
                              <br>
                              <div class="mb-3">
                                <label for="formFile" class="form-label">Unggah Dokumen</label>
                                <input class="form-control" type="file" id="formFile" name="file1">
                              </div>
                              <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">tutup</button><button class="btn btn-primary" type="submit">Simpan</button></div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="/pelanggan" method="POST" enctype="multipart/form-data" id="editForm">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Nomor SO</label>
                              <input type="text" name="nomor_so" class="form-control" id="nomor_so" required>
                            </div>
                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                              </div>
                              <label for="text" class="form-label">Status</label>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="stat_aktif" value="AKTIF">
                                <label class="form-check-label" for="flexRadioDefault1">
                                  Aktif
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="stat_nonaktif" value="NONAKTIF">
                                <label class="form-check-label" for="flexRadioDefault2">
                                  Non Aktif
                                </label>
                              </div>
                              <br>
                              <div class="mb-3">
                                <label for="formFile" class="form-label">Unggah Dokumen</label>
                                <input class="form-control" type="file" id="formFile" name="file1">
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">tutup</button>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                          </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="display:none;">Id</th>
                        <th style="display:none;">Status</th>
                        <th>Nomor SO</th>
                        <th>Pelanggan</th>
                        <th>Status</th>
                        <th>Alamat</th>
                        <th>Tanggal Upload</th>
                        @role('activator|maintainer')
                        <th>Aksi</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $key => $value)
                    <tr>
                        <td style="display:none;">{{$value->id}}</td>
                        <td style="display:none;">{{$value->status}}</td>
                        <td>{{ $value->nomor_so ?? '' }}</td>
                        <td>{{ $value->nama }}</td>
                        <td><span class="badge badge-{{ $value->status == 'AKTIF' ? 'success' : 'warning' }}">{{ $value->status }}</span></td>
                        <td>{{ $value->alamat }}</td>
                        <td>{{ $value->updated_at->format('d-M-Y') }}</td>
                        @role('activator|maintainer')
                        <td>
                            @role('activator|maintainer')
                            <form action="{{route('pelanggan.destroy', [$value->id])}}" method="POST">
                                @csrf
                                @method('delete')
                                @role('activator')
                                <a href="#" class="btn btn-primary edit">edit</a>
                                <button class="btn btn-danger btn-delete" type="submit">delete</button>
                                @endrole
                                @role('activator|maintainer')
                                @if($value->file1 != null)
                                <a target="_blank" href="{{route('pelanggan.download', [$value->id])}}" class="btn btn-info">download</a>
                                @endif
                                @endrole
                              </form>
                            @endrole
                        </td>
                        @endrole
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection