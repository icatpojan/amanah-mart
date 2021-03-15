                <!-- Modal -->
                <div class="modal fade" id="tambah-karyawan" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-tambah">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="text-primary font-weight-bold pt-2">TAMBAH KARYAWAN</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-12 p-3">
                                            {{-- start form --}}
                                            <form action="{{ route('karyawan.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>Nama : </label>
                                                        <input type="text" class="form-control" name="name" autofocus
                                                            value="{{ old('name') }}" required  autocomplete="">
                                                    </div>
                                                    <div class="col">
                                                        <label>email : </label>
                                                        <input type="email" class="form-control" name="email"
                                                            placeholde="enter email" value="{{ old('email') }}"
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
                                                        <label>password : </label>
                                                        <input type="password" class="form-control" name="password"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>phone number : </label>
                                                        <input type="number" class="form-control" name="phone_number"
                                                            value="{{ old('phone_number') }}" required>

                                                    </div>
                                                    <div class="col">
                                                        <label>alamat : </label>
                                                        <input type="text" class="form-control" name="address"
                                                            value="{{ old('alamat') }}" required>

                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>umur : </label>
                                                        <input type="number" class="form-control" name="umur"
                                                            value="{{ old('umur') }}" required>
                                                    </div>
                                                    <div class="col">
                                                        <label>foto : </label>
                                                        <input type='file' class="form-control" id="imgInp"
                                                            name="image" />
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col" style="text-align: center">
                                                        <img id="blah" src="#" alt="your image" width="250px" />
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
                                        Create
                                    </button>
                                    </form>
                                    {{-- End form --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <!-- Modal -->
                @foreach ($User as $user)

                    <div class="modal fade" id="update-karyawan-{{ $user->user_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="text-primary font-weight-bold pt-2">LIHAT KARYAWAN</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-12 p-3">
                                            {{-- start form --}}
                                            <form action="{{ route('karyawan.update', $user->user_id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>Nama : </label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $user->user->name }}" required>

                                                    </div>
                                                    <div class="col">
                                                        <label>email : </label>
                                                        <input type="text" class="form-control" name="email"
                                                            value="{{ $user->user->email }}" disabled required>

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
                                                            value="{{ $user->phone_number }}" required>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>alamat : </label>
                                                        <input type="text" class="form-control" name="address"
                                                            value="{{ $user->address }}" required>

                                                    </div>
                                                    <div class="col">
                                                        <label>umur : </label>
                                                        <input type="number" class="form-control" name="umur"
                                                            value="{{ $user->umur }}" value="0" required>

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
                                                        <img src="{{ $user->image }}" width="250px" />
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
