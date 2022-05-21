@extends('layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-white text-capitalize ps-3">Lịch tiêm chủng</h4>
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
                                    <th> Tên vắc-xin</th>
                                    <th>Độ tuổi</th>
                                    <th>Mô tả</th>
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
                            <h5 class="">Thêm thông tin Vắc-xin</h5>
                            <p class="mb-0">Nhập thông tin vắc-xin cần thêm</p>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" id="vaccine_form" action="#">
                                @csrf
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Tên vắc-xin</label>
                                    <input type="text" class="form-control" name="name" onfocus="focused(this)"
                                        onfocusout="defocused(this)" required>
                                </div>
                                <label for="age_distance">Độ tuổi</label>
                                <div class="input-group input-group-outline">

                                    <input type="text" class="form-control" id="age_distance" placeholder="vd: 2-5"
                                        name="age_distance" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                    <select class="form-select p-2" aria-label="Default select example" name="age_type">
                                        <option selected value="tháng">Tháng</option>
                                        <option value="tuổi">Tuổi</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-outline my-3">
                                    {{-- <label class="form-label">Mô tả</label> --}}
                                    <textarea placeholder="Mô tả" class="form-control" name="description" onfocus="focused(this)"
                                        onfocusout="defocused(this)" required></textarea>
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
                ajax: '{!! route('vaccine.all') !!}',
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
                        data: 'age',
                        name: 'age'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        defaultContent: 'Chưa cập nhật'
                    },
                    {
                        orderable: false,
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
            $(document).on('submit', '#vaccine_form', function() {
                // do your things
                addVaccine();
                return false;
            });
        });
        //summit form to add parent

        //function add new parent to database ajax
        function addVaccine() {
            var form = $('#vaccine_form');
            // if (form.valid()) {
            $.ajax({
                url: '{!! route('vaccine.store') !!}',
                type: 'POST',
                data: $('#vaccine_form').serialize(),
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

        function delVaccine(id) {
            var url = '{!! route('vaccine.delete', ':id') !!}';
            url = url.replace(':id', id);
            if (confirm('Bạn có chắc chắn muốn xóa? Thao tác này không thể hoàn tác')) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        if (data.status == 'success') {
                            $('#parents-table').DataTable().ajax.reload();
                            // alert(data.message);
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
            }

        }
    </script>
@endpush
