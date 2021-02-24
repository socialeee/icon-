<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pelanggan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pelanggan.update', [$data->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
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
                      <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">tutup</button><button class="btn btn-primary" type="submit">Update</button></div>
                  </form>
            </div>
        </div>
    </div>
</div>