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
                        {{ $dataTable->table(['id' => 'vaccinationdetails-table']) }}
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
                ajax: 'vaccinationdetails',
                table: "#vaccinationdetails-table",
                display: 'bootstrap',
                fields: [{
                        label: "Tên trẻ em",
                        name: "child_id",
                        type: "select",
                        // placeholder: "Tên Vắc-xin",
                        options: [
                            @foreach ($childs as $child)
                                {
                                    label: "{{ $child->name }}",
                                    value: "{{ $child->id }}"
                                },
                            @endforeach
                        ]
                    },
                    {
                        label: "Tên vắc-xin",
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
                        label: "Số lô",
                        name: "lot_number",
                        attr: {
                            type: "number"
                        }
                    },
                    {
                        label: "Số mũi điều trị",
                        name: "number_injections",
                        attr: {
                            type: "number"
                        }
                    },
                ],
                i18n: {
                    create: {
                        title: "<h4>Thêm thông tin mũi tiêm chủng</h4>",
                        button: 'Thêm',
                        submit: 'Thêm '
                    },
                    edit: {
                        title: "<h4>Sửa thông tin</h4>",
                        button: 'Sửa',
                        submit: 'Sửa'
                    },
                    remove: {
                        title: "<h4>Xóa thông tin</h4>",
                        button: "Xóa",
                        submit: 'Xóa ',
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
