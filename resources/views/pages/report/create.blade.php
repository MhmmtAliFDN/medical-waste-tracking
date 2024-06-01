@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{"Yeni ".request()->segment(1)." Ekle"}}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form id="form-add-entity">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-4 d-none">
                                    <label>{{"USERID"}}</label>
                                    <input type="text" class="form-control" id="user_id"
                                           name="user_id" value="{{auth()->user()->getAuthIdentifier()}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{"Başlık"}}</label>
                                    <input type="text" class="form-control" id="title"
                                           name="title" placeholder="ör. Dönem Raporu">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{"Tarih Aralığı"}}</label>
                                    <input class="form-control input-daterange-datepicker" type="text" name="date_range" value="01/05/2024 - 30/05/2024">
                                </div>
                            </div>
                            <button type="submit" id="btn-add-entity" class="btn btn-primary">{{"Kaydet"}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('customCss')
    <link href="{{asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endpush
@push('customJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/vendor/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/bs-daterange-picker-init.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $(document).ready(function () {
            $('#form-add-entity').on('submit', function (e) {
                e.preventDefault();

                let formData = $(this).serialize();
                $.ajax({
                    url: '{{ route('report.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        alert(response.message);
                        window.location.href = response.redirect;
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            for (let field in errors) {
                                errorMessage += errors[field].join(' ') + '\n';
                            }
                            alert(errorMessage);
                        } else if (xhr.status === 404) {
                            let error = xhr.responseJSON.error;
                            alert(error);
                        } else {
                            alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
