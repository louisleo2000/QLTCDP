@extends('layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-white text-capitalize ps-3">Quản lý thông tin phụ huynh</h6>
                            </div>
                            <div class="col-md-4 d-flex flex-row-reverse me-2">
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#modal-form">Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-3 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0 text-center text-capitalize"
                            id="parents-table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th> Họ và tên</th>
                                    <th>Giới tính</th>
                                    <th>CMND/CCCD</th>
                                    <th>Điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h5 class="">Thêm thông tin phụ huynh</h5>
                            <p class="mb-0">Nhập thông tin phụ huynh đăng ký</p>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" id="parent_form" action="#">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" name="name" onfocus="focused(this)"
                                        onfocusout="defocused(this)" required>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" onfocus="focused(this)"
                                        onfocusout="defocused(this)" required>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" onfocus="focused(this)"
                                        onfocusout="defocused(this)" required>
                                </div>
                                <div>
                                    <label class="form-label">Giới tính:</label>
                                    <input class=" ms-3" type="radio" name="gender" id="nam" value="nam" checked>
                                    <label class="form-check-label" for="nam">
                                        Nam
                                    </label>
                                    <input class=" ms-5" type="radio" name="gender" value="nữ" id="nu">
                                    <label class="form-check-label" for="nu">
                                        Nữ
                                    </label>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">CMND/CCCD</label>
                                    <input type="text" name="citizen_id" class="form-control" onfocus="focused(this)"
                                        onfocusout="defocused(this)" required>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Điện thoại</label>
                                    <input type="text" name="tel" class="form-control" onfocus="focused(this)"
                                        onfocusout="defocused(this)" required>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Địa chỉ</label>
                                    <input type="text" name="adress" class="form-control" onfocus="focused(this)"
                                        onfocusout="defocused(this)">
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Thêm</button>
                                </div>
                            </form>
                        </div>
                        {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Don't have an account?
                                <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a>
                            </p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(function() {
            $('#parents-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('parent.all') !!}',
                language:language,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'citizen_id',
                        name: 'citizen_id',
                        defaultContent: 'Chưa cập nhật'
                    },
                    {
                        data: 'tel',
                        name: 'tel',
                        defaultContent: 'Chưa cập nhật'
                    },
                    {
                        data: 'adress',
                        name: 'adress',
                        defaultContent: 'Chưa cập nhật'
                    },
                    {
                        orderable: false,
                        data: 'editbtn',
                        name: 'editbtn'
                    },
                ]
            });
            $(document).on('submit', '#parent_form', function() {
                // do your things
                addParent();
                return false;
            });
        });
        //summit form to add parent

        //function add new parent to database ajax
        function addParent() {
            var form = $('#parent_form');
            // if (form.valid()) {
            $.ajax({
                url: '{!! route('parent.store') !!}',
                type: 'POST',
                data: $('#parent_form').serialize(),
                success: function(data) {
                    if (data.status == 'success') {
                        $('#modal-form').modal('hide');
                        $('#parents-table').DataTable().ajax.reload();
                    } else {
                        alert(data.message);
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // When AJAX call has failed
                    console.log('AJAX call failed.');
                    alert(textStatus + ': ' + errorThrown);
                },

            });
            // }
        }
    </script>
@endpush
