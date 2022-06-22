@extends('layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{$title}}</h6>
                    </div>
                </div>
                <div class="card-body px-3 pb-2">
                    <div class="table-responsive p-0">
                        {{-- <table class="table align-items-center justify-content-center mb-0 text-center text-capitalize"
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
                        </table> --}}
                        {{ $dataTable->table(['id' => 'medicalstaff-table']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
{{-- @push('scripts')
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
@endpush --}}
@push('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var editor = new $.fn.dataTable.Editor({
                ajax: 'medicalstaff',
                table: "#medicalstaff-table",
                display: 'bootstrap',
                fields: [{
                        label: "Họ và tên:",
                        name: "user.name",

                    },
                    {
                        label: "Email:",
                        name: "user.email",

                    },
                    {
                        label: "Mật khẩu:",
                        name: "user.password",
                        attr: {
                            type: "password"
                        }

                    },
                    {
                        label: "CCCD/CMND:",
                        name: "citizen_id",
                    },
                    {
                        label: "Điện thoại:",
                        name: "tel",
                    },
                    {
                        label: "Ảnh:",
                        name: "img",
                    },
                    {
                        label: "Địa chỉ:",
                        name: "adress",
                    },
                    {
                        label: "Giới tính",
                        name: "gender",
                        type: "select",
                        // placeholder: "Tên Vắc-xin",
                        options: [{
                                label: "Nam",
                                value: "nam"
                            },
                            {
                                label: "Nữ",
                                value: "nữ"
                            },
                        ]
                    },
                ],
                i18n: {
                    create: {
                        title: "<h4>Thêm thông tin</h4>",
                        button: 'Thêm',
                        submit: 'Thêm'
                    },
                    edit: {
                        title: "<h4>Sửa thông tin</h4>",
                        button: 'Sửa',
                        submit: 'Sửa'
                    },
                    remove: {
                        title: "<h4>Xóa thông tin</h4>",
                        button: "Xóa",
                        submit: 'Xóa',
                        confirm: 'Bạn có chắc chắn muốn xóa?'
                    },
                }
            });
            // editor.on('initEdit', function() {
            //     editor.show(); //Shows all fields
            //     editor.hide('user.password'); //Hides a field
            // });
            // $('#schedule-table').on('click', 'tbody td:not(:first-child)', function(e) {
            //     editor.inline(this);
            // });
            {{ $dataTable->generateScripts() }}

        });
    </script>
@endpush
