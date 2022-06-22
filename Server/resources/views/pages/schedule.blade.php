@extends('layouts.app')
@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <div class="row">
                            <div class="col">
                                <h6 class="text-white text-capitalize ps-3">{{$title}}</h6>
                            </div>
                            {{-- <div class="col-md-4 d-flex flex-row-reverse me-2">
                                <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                    data-bs-target="#modal-form">Thêm</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body px-3 pb-2">
                    <div class="table-responsive p-0">
                        {{ $dataTable->table(['id' => 'schedule-table']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@push('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var editor = new $.fn.dataTable.Editor({
                ajax: 'schedule',
                table: "#schedule-table",
                display: 'bootstrap',
                    fields: [{
                        label: "Tên Vắc-xin",
                        name: "vaccine_id",
                        type: "select",
                        // placeholder: "Tên Vắc-xin",
                        options: [
                            @foreach ($vaccines as $vaccine)
                                {
                                    label: "{{ $vaccine->name }}",
                                    value: "{{ $vaccine->id }}"
                                },
                            @endforeach
                        ]


                    },
                    {
                        label: "Trạng thái",
                        name: "status",
                        type: "select",
                        // placeholder: "Tên Vắc-xin",
                        options: [
                            {
                                label: "Đang chuẩn bị",
                                value: "Đang chuẩn bị"
                            },
                            {
                                label: "Chưa bắt đầu",
                                value: "Chưa bắt đầu"
                            },
                            {
                                label: "Đang diễn ra",
                                value: "Đang diễn ra"
                            },
                            {
                                label: "Đã kết thúc",
                                value: "Đã kết thúc"
                            },
                            {
                                label: "Đã hủy",
                                value: "Đã hủy"
                            },
                        ]
                    },
                    {
                        label: "Ngày bắt đầu",
                        name: "date_time",
                        type: "datetime",
                        def: function() {
                            return new Date();
                        },
                        format: 'YYYY-MM-DD HH:mm:ss',
                        opts: {
                            minutesIncrement: 5
                        }

                    }
                ],
                i18n: {
                    create: {
                        title: "<h4>Thêm lịch tiêm chủng</h4>",
                        button: 'Thêm',
                        submit: 'Tạo lịch'
                    },
                    edit: {
                        title: "<h4>Sửa lịch tiêm</h4>",
                        button: 'Sửa',
                        submit: 'Sửa lịch'
                    },
                    remove: {
                        title: "<h4>Xóa lịch tiêm</h4>",
                        button: "Xóa",
                        submit: 'Xóa lịch',
                        confirm: 'Bạn có chắc chắn muốn xóa lịch tiêm này?'
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
