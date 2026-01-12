<!-- Modal -->
<div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel">Hapus {{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-2"></i>Tutup</button>
            <form action="{{ route('tugasDestroy',$item->id) }}" method="post">
                @csrf
                @method('delete')
                 <button  type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-trash mr-2"></i>Hapus
        </button>
            </form>
      </div>
    </div>
  </div>
</div>