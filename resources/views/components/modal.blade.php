                <!-- Modal -->
                <div class="modal fade" id="tambah-product" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="text-primary font-weight-bold pt-2">TAMBAH PRODUCT</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-md-12 p-3">
                                        {{-- start form --}}
                                        <form action="{{ route('product.store') }}" method="POST">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label>Nama : </label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                                <div class="col">
                                                    <label>Barcode : </label>
                                                    <input type="number" class="form-control" name="barcode" placeholde="unik jangan sama"required>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label>supplier : </label>
                                                    <select class="form-control" name="supplier_id">
                                                        @foreach ($Supplier as $supplier)
                                                            <option value="{{ $supplier->id }}" selected>
                                                                {{ $supplier->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col select-role">
                                                    <label>katagori : </label>
                                                    <select class="form-control" name="category_id">
                                                        @foreach ($Category as $category)
                                                            <option value="{{ $category->id }}" selected>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label>merek : </label>
                                                    <input type="text" class="form-control" name="merek" required>

                                                </div>
                                                <div class="col">
                                                    <label>diskon : </label>
                                                    <input type="number" class="form-control" name="diskon" value="0" required>

                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label>harga beli : </label>
                                                    <input type="text" class="form-control" name="harga_beli" required>

                                                </div>
                                                <div class="col">
                                                    <label>harga jual : </label>
                                                    <input type="number" class="form-control" name="harga_jual" value="0" required>

                                                </div>
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
                @foreach ($Product as $Produk)

                    <div class="modal fade" id="update-product-{{ $Produk->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="text-primary font-weight-bold pt-2">UPDATE PRODUCT</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-12 p-3">
                                            {{-- start form --}}
                                            <form action="{{ route('product.update', $Produk->id) }}" method="POST">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>Nama : </label>
                                                        <input type="text" class="form-control" name="name" value="{{$Produk->name}}"required>
                                                    </div>
                                                    <div class="col">
                                                        <label>Barcode : </label>
                                                        <input type="number" class="form-control" name="barcode" placeholde="unik jangan sama" value="{{$Produk->barcode}}"required>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>supplier : </label>
                                                        <select class="form-control" name="supplier_id">
                                                            @foreach ($Supplier as $supplier)
                                                                <option value="{{ $supplier->id }}" selected>
                                                                    {{ $supplier->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col select-role">
                                                        <label>katagori : </label>
                                                        <select class="form-control" name="category_id">
                                                            @foreach ($Category as $category)
                                                                <option value="{{ $category->id }}" selected>
                                                                    {{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>merek : </label>
                                                        <input type="text" class="form-control" name="merek" value="{{$Produk->merek}}"required>

                                                    </div>
                                                    <div class="col">
                                                        <label>diskon : </label>
                                                        <input type="number" class="form-control" name="diskon" value="{{$Produk->diskon}}"value="0" required>

                                                    </div>
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
                @endforeach

                <!-- Modal -->
