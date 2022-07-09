@extends('layouts.app')
@section('content')
    <style>

        .form-control:focus {
            /* width: 100%; */
            border: 2px solid #ced4da;
        }.form-control {
            border: 2px solid #ced4da;
            /* height: 44px; */
        }
        input.form-control {
            /* border: 2px solid #ced4da; */
            height: 44px;
        }
    </style>
    <div class="row mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        {{-- get session error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-9">
            {{-- get session success --}}

            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $title }}</h6>
                    </div>
                </div>


                <div class="card-body px-3 pb-2">
                    <div class=" p-0">
                        {{-- form send message --}}
                        <form action="{{ route('message.store') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="form-group  mb-3">
                                <label for="title" class="col-sm-5 col-form-label">Tiêu đề</label>

                                <input class="form-control" id="title" name="title"
                                    placeholder="Nhập tiêu đề thông báo">

                            </div>
                            <div class="form-group mb-3">
                                <label for="img" class="col-sm-5 col-form-label">Hình ảnh</label>
                                <br>
                                <div class=" input-group ">
                                    <input type="text" min="2" maxlength="50" class="form-control" id="img"
                                        name="image" placeholder="Thêm đường dẫn hình ảnh">
                                    <div class="input-group-append">

                                        <button id="lfm" style="width: 120px; height: 44px;" data-input="img"
                                            data-preview="holder" class="lfm btn btn-secondary text-white  p-0"> <i
                                                class="fas fa-image "></i>Chọn
                                            ảnh</button>
                                    </div>
                                </div>
                            </div>
                            <div id="holder" class="mt-3 w-100" style="display: none;max-height: 150px">
                                <img height="100%">
                            </div>
                            <div class="form-group">
                                <label for="body" class="col-sm-5 col-form-label">Nội dung</label>
                                <textarea class="form-control" id="body" minlength="10" maxlength="255" name="body" rows="3"
                                    placeholder="Nhập nội dung tin nhắn"></textarea>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-info">Gửi</button>
                                </div>
                            </div>
                        </form>
                        {{-- end form send message --}}

                    </div>
                </div>
            </div>
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

            //when input img change
            $('#img').on('change', function(event) {
                console.log(event.target.baseURI);
                var val = event.target.baseURI;

                if (val != '') {
                    $('#holder').show();
                    // console.log(val);
                    $('#holder img').attr('src', val)
                } else {
                    $('#holder').hide();
                }
            });


        });
    </script>
@endpush
