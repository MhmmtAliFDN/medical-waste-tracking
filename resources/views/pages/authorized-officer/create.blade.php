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
                                <div class="form-group col-md-12">
                                    <label>{{"Personel"}}</label>
                                    <select id="users" name="user_id" class="form-control">
                                        <option selected>{{"Personel Seçiniz"}}</option>
                                        @if(isset($users) && count($users)>0)
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
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

@push('customJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    url: '{{ route('authorized-officer.store') }}',
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
                        } else {
                            alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                        }
                    }
                });
            });
        });
    </script>
@endpush
