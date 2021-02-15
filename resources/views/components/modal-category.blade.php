   <!-- Modal -->

   <div class="modal fade" id="tambah-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-primary font-weight-bold pt-2">TAMBAH CATEGORY</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 p-3">
                        {{-- start form --}}
                        <form action="{{ route('category.store') }}" method="POST">
                            <div class="form-group mb-2">
                                <label>Nama : </label>
                                <input class="form-control" name="name" cols="30" rows="30" required>
                            </div>
                            @csrf
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Close
                </button>
                <button class="btn btn-primary">
                    Create
                </button>
                </form>
                {{-- End form --}}
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<!-- Modal -->

@foreach ($Category as $katagori)
<div class="modal fade" id="update-category-{{ $katagori->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-primary font-weight-bold pt-2">UPDATE CATEGORY</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12 p-3">
                        {{-- start form --}}
                        <form action="{{ route('category.update', $katagori->id) }}" method="POST">
                         <div class="form-group mb-2">
                             <label>Nama :</label>
                             <input class="form-control" name="name" cols="30" rows="30"
                                 value="{{ $katagori->name }}" required>
                         </div>
                            @csrf
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    aria-label="Close">
                    Close
                </button>
                <button class="btn btn-primary">
                    update
                </button>
                </form>
                {{-- End form --}}
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal -->
