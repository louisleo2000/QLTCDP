@extends('layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Quản lý thông tin phụ huynh</h6>
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
@stop
@push('scripts')
    <script>
        $(function() {
            $('#parents-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('parent.all') !!}',
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
        });
    </script>
@endpush
