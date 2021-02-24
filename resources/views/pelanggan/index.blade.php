@extends('layouts.app')
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
        @role('sales')
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
                              <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                              <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" required>
                              </div>
                              @role('activator')
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
                              @endrole
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
                                <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                                <input type="text" name="nama" class="form-control" id="nama" required @if(auth()->user()->hasRole('activator|maintainer')) disabled @endif>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required @if(auth()->user()->hasRole('activator|maintainer')) disabled @endif>
                              </div>
                              @role('activator')
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
                              @endrole
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
                        <th>pelanggan</th>
                        <th>status</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $key => $value)
                    <tr>
                        <td style="display:none;">{{$value->id}}</td>
                        <td style="display:none;">{{$value->status}}</td>
                        <td>{{ $loop->iteration ?? '' }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->status }}</td>
                        <td>{{ $value->alamat }}</td>
                        <td>
                            <form action="{{route('pelanggan.destroy', [$value->id])}}" method="POST">
                                @csrf
                                @method('delete')
                                @role('activator|sales')
                                <a href="#" class="btn btn-primary edit">edit</a>
                                <button class="btn btn-danger btn-delete" type="submit">delete</button>
                                @endrole
                                <a target="_blank" href="{{route('pelanggan.download', [$value->id])}}" class="btn btn-info">download</a>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection