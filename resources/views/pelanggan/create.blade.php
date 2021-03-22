<!-- Modal Tambah -->
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Menambah Pelanggan Baru</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
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
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Pelaksana Tugas</label>
                    <input type="text" name="ptl" class="form-control" id="ptl" required>
                  </div>
                  <br>
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Unggah Dokumen</label>
                    <input class="form-control" type="file" id="formFile" name="file1[]" multiple="true">
                  </div>
                  <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">tutup</button><button class="btn btn-primary" type="submit">Simpan</button></div>
              </form>
        </div>
    </div>
</div>