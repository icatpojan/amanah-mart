                <!-- Modal -->
                <div class="modal fade" id="tambah-member" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="text-primary font-weight-bold pt-2">TAMBAH-MEMBER</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-md-12 p-3">
                                        {{-- start form --}}
                                        <form action="{{ route('member.store') }}" method="POST">
                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label>Nama : </label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                                <div class="col">
                                                    <label>Email : </label>
                                                    <input type="email" class="form-control" name="email" required>
                                                </div>
                                            </div>

                                            <div class="form-group mb-2">
                                                <div>
                                                    <label>No. Telepon : </label>
                                                    <input type="number" class="form-control" name="phone_number"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label>umur : </label>
                                                    <input type="number" class="form-control" name="umur" required>

                                                </div>
                                                <div class="col">
                                                    <label>Password : </label>
                                                    <input type="password" class="form-control" name="password"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label>Alamat</label>
                                                <textarea class="form-control" name="address" cols="30" rows="3"
                                                    required></textarea>
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
                @foreach ($Member as $user)

                    <div class="modal fade" id="update-member-{{ $user->user_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="text-primary font-weight-bold pt-2">UPDATE MEMEBER</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 p-3">
                                            {{-- start form --}}
                                            <form action="{{ route('member.update', $user->user_id) }}" method="POST">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>Nama : </label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $user->user->name }}" required>
                                                    </div>
                                                    <div class="col">
                                                        <label>No. Telepon : </label>
                                                        <input type="number" class="form-control" name="phone_number"
                                                            value="{{ $user->phone_number }}" required>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Alamat</label>
                                                    <input class="form-control" name="address" cols="30" rows="30"
                                                        value="{{ $user->address }}" required>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label>Umur</label>
                                                        <input class="form-control" name="umur"
                                                            value="{{ $user->umur }}" required>
                                                    </div>
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
