<!-- Modal Edit -->
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pelanggan.update', [$data->id]) }}" method="POST" enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nomor SO</label>
                  <input type="text" name="nomor_so" class="form-control" id="nomor_so" value="{{ old('nomor_so') ?? $data->nomor_so }}" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama Pelanggan</label>
                  <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') ?? $data->nama }}" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat') ?? $data->alamat }}" required>
                </div>
                <label for="text" class="form-label">Status</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="stat_aktif" value="AKTIF" @if($data->status == 'AKTIF') checked @endif>
                  <label class="form-check-label" for="flexRadioDefault1">
                    Aktif
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="stat_nonaktif" value="NONAKTIF" @if($data->status == 'NONAKTIF') checked @endif>
                  <label class="form-check-label" for="flexRadioDefault2">
                    Non Aktif
                  </label>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Pelaksana Tugas</label>
                  <input type="text" name="ptl" class="form-control" id="ptl" value="{{ old('ptl') ?? $data->ptl }}" required>
                </div>
                <br>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Unggah Dokumen</label>
                    <input class="form-control" type="file" id="formFile" name="file1[]" multiple="true">
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">tutup</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
              </form>
        </div>
    </div>
</div>