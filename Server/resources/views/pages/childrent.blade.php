@extends('layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $title }}</h6>
                    </div>
                </div>
                <div class="card-body px-3 pb-2">
                    <div class="table-responsive p-0">
                        {{ $dataTable->table(['id' => 'childrent-table']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="display: none">
        <div id="customForm">
            <fieldset>
                <div data-editor-template="name"></div>
            </fieldset>
            <fieldset>
                <div data-editor-template="user.email"></div>
            </fieldset>
            {{-- <fieldset>
                <div data-editor-template="user.password"></div>
            </fieldset> --}}
            <fieldset>
                <div data-editor-template="gender"></div>
            </fieldset>
            <fieldset>
                <div class="input-group mb-3">
                    <div class="col" data-editor-template="img"></div>
                    <div class="input-group-append">
                        <button id="lfm" style="width: 120px; height: 44px; margin-top: 41px"
                            data-input="DTE_Field_img" data-preview="holder" class="lfm btn btn-secondary text-white p-0">
                            <i class="fas fa-image "></i>Chọn
                            ảnh</button>
                    </div>
                </div>
                <div id="holder" style="margin-top:15px;max-height:200px;display: none"><img style="height: 12rem;">
                </div>
            </fieldset>
            <fieldset>
                <div data-editor-template="health_nsurance_id"></div>
            </fieldset>
            <fieldset>
                <div data-editor-template="height"></div>
            </fieldset>
            <fieldset>
                <div data-editor-template="weight"></div>
            </fieldset>

        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(function() {
            $('#lfm').filemanager('image');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var editor = new $.fn.dataTable.Editor({
                ajax: 'childrent',
                table: "#childrent-table",
                template: '#customForm',
                display: 'bootstrap',
                fields: [{
                        label: "Họ và tên:",
                        name: "name",

                    },
                    {
                        label: "Email phụ huynh:",
                        name: "user.email",

                    },
                    {
                        label: "Ngày sinh:",
                        name: "dob",

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
                    {
                        label: "Ảnh:",
                        name: "img",
                    },
                    {
                        label: "Số bảo hiểm y tế:",
                        name: "health_nsurance_id",
                    },
                    {
                        label: "Chiều cao:",
                        name: "height",
                    },
                    {
                        label: "Cân nặng:",
                        name: "weight",
                    },


                ],
                i18n: {
                    create: {
                        title: "<h4>Thêm trẻ em</h4>",
                        button: 'Thêm',
                        submit: 'Thêm'
                    },
                    edit: {
                        title: "<h4>Sửa thong tin</h4>",
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
            // $('#schedule-table').on('click', 'tbody td:not(:first-child)', function(e) {
            //     editor.inline(this);
            // });
            {{ $dataTable->generateScripts() }}
            setImgHolder(editor)
            editor.on('initEdit', function() {
                editor.show(); //Shows all fields
                editor.hide('user.email');
            });
        });
    </script>
@endpush
