@extends('layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Quản lý thông tin trẻ</h6>
                    </div>
                </div>
                <div class="card-body px-3 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0 text-center text-capitalize"
                            id="childs-table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th> Họ và tên</th>
                                    <th>Giới tính</th>
                                    <th> Ngày sinh</th>
                                    <th>Chiều cao(cm)</th>
                                    <th>Cân nặng(kg)</th>
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
            $('#childs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('child.all') !!}',
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
                        data: 'dob',
                        name: 'dob'
                    },
                    {
                        data: 'height',
                        name: 'height'
                    },
                    {
                        data: 'weight',
                        name: 'weight'
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
