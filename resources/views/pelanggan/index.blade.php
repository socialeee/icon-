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
            <button class="btn btn-primary btn-modal" data-href="{{ route('pelanggan.create') }}" data-container=".my-modal">Tambah Pelanggan</button>
        </div>
        @endrole
        <div class="table-responsive">
            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nomor SO</th>
                        <th>Pelanggan</th>
                        <th>Status</th>
                        <th>Alamat</th>
                        <th>Tanggal Upload</th>
                        <th>Pelaksana</th>
                        @role('activator|maintainer')
                        <th>Aksi</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggan as $key => $value)
                    <tr>
                        <td>{{ $value->nomor_so ?? '' }}</td>
                        <td>{{ $value->nama }}</td>
                        <td><span class="badge badge-{{ $value->status == 'AKTIF' ? 'success' : 'warning' }}">{{ $value->status }}</span></td>
                        <td>{{ $value->alamat }}</td>
                        <td>{{ $value->updated_at->format('d-M-Y') }}</td>
                        <td>{{ $value->ptl }}</td>
                        @role('activator|maintainer')
                        <td>
                            @role('activator|maintainer')
                            <form action="{{route('pelanggan.destroy', [$value->id])}}" method="POST">
                                @csrf
                                @method('delete')
                                @role('activator')
                                <button class="btn btn-primary btn-modal" data-href="{{ route('pelanggan.edit', [$value->id]) }}" data-container=".my-modal">edit</button>
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
<div class="modal fade my-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
@endsection