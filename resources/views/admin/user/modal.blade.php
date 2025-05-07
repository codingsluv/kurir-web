
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Hapus {{ $title }} ? </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
                Nama
            </div>
            <div class="col-6">
                : {{ $item->name }}
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <form action="{{ route('deleteUser', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
      </div>
    </div>
  </div>
