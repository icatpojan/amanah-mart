<div class="modal fade" id="update-karyawan" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="text-primary font-weight-bold pt-2">UPDATE KARYAWAN</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-12 p-3">
                                                    {{-- start form --}}
                                                    <form action="{{ route('karyawan.update', $Karyawan->user_id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <label>Nama : </label>
                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $Karyawan->user->name }}" required>

                                                            </div>
                                                            <div class="col">
                                                                <label>email : </label>
                                                                <input type="text" class="form-control" name="email"
                                                                    value="{{ $Karyawan->user->email }}" disabled
                                                                    required>

                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <label>Role : </label>
                                                                <select class="form-control" name="role_id">
                                                                    <option value="2" selected>Pimpinan</option>
                                                                    <option value="3">Staff</option>
                                                                    <option value="4">Kasir</option>
                                                                </select>

                                                            </div>

                                                            <div class="col select-role">
                                                                <label>nomor telpon : </label>
                                                                <input type="text" class="form-control" name="phone_number"
                                                                    value="{{ $Karyawan->phone_number }}" required>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <label>alamat : </label>
                                                                <input type="text" class="form-control" name="address"
                                                                    value="{{ $Karyawan->address }}" required>

                                                            </div>
                                                            <div class="col">
                                                                <label>umur : </label>
                                                                <input type="number" class="form-control" name="umur"
                                                                    value="{{ $Karyawan->umur }}" value="0" required>

                                                            </div>
                                                        </div>

                                                        <div class="row mb-2">
                                                            <div class="col">
                                                                <label>foto : </label>
                                                                <input type="file" class="form-control" name="image" />
                                                            </div>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <div class="col" style="text-align: center">
                                                                <img src="{{ $Karyawan->image }}" width="250px" />
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                aria-label="Close">
                                                Close
                                            </button>
                                            <button class="btn btn-primary">
                                                Update
                                            </button>
                                            </form>
                                            {{-- End form --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
