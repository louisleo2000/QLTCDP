@extends('layouts.app')
@section('content')
    <style>
        .age label {
            display: none;
        }
    </style>
    
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

                        {{ $dataTable->table(['id' => 'vaccine-table']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
<div id="customForm" style="display: none">
    <fieldset>
        <div data-editor-template="name"></div>
        {{-- <div data-editor-template="last_name"></div> --}}
    </fieldset>
    <fieldset>
        <label data-dte-e="label" class="col-lg-4 col-form-label" for="DTE_Field_age_distance">Độ tuổi:<div
                data-dte-e="msg-label" class="DTE_Label_Info"></div></label>
        <div class="row age">
            <div class="col-9 pe-0" data-editor-template="age_distance"></div>
            <div class="col-3 "data-editor-template="age_type"></div>
        </div>
    </fieldset>
    <fieldset class="hr">
        <div data-editor-template="description"></div>
    </fieldset>
</div>
@push('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var editor = new $.fn.dataTable.Editor({
                ajax: 'vaccine',
                table: "#vaccine-table",
                // template: '#customForm',
                display: 'bootstrap',
                fields: [{
                        label: "Tên Vắc-xin:",
                        name: "name",

                    },
                    {
                        label: "Độ tuổi:",
                        name: "age_distance",


                    },
                    {
                        label: "Loại tuổi",
                        name: "age_type",
                        type: "select",
                        className: 'full',
                        // placeholder: "Tên Vắc-xin",
                        options: [

                            {
                                label: "Tháng",
                                value: "tháng"
                            },
                            {
                                label: "Tuổi",
                                value: "tuổi"
                            },

                        ]
                    },
                    {
                        label: "Mô tả",
                        name: "description",
                        type: "textarea",

                    },
                    // {
                    //     label: "Hình ảnh",
                    //     name: "img",
                    //     type: "upload",

                    // },

                ],
                i18n: {
                    create: {
                        title: "<h4>Thêm thông tin Vắc-xin</h4>",
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
            // $('#schedule-table').on('click', 'tbody td:not(:first-child)', function(e) {
            //     editor.inline(this);
            // });
            {{ $dataTable->generateScripts() }}

        });
    </script>
@endpush
