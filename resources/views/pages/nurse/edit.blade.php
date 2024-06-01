@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{request()->segment(1)." Düzenle"}}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form id="form-update-entity">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-4 d-none">
                                    <input type="text" class="form-control" id="id" name="id"
                                           value="{{ $nurse->id }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="registry_number">{{"Sicil Numarası"}}</label>
                                    <input type="number" class="form-control" id="registry_number"
                                           value="{{ $nurse->registry_number }}"
                                           name="registry_number" placeholder="ör. 1234">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="specialization">{{"Departmanı"}}</label>
                                    <input type="text" class="form-control" id="department" name="department"
                                           value="{{ $nurse->department }}"
                                           placeholder="ör. Ameliyathane">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>{{"Personel"}}</label>
                                    <select id="users" name="user_id" class="form-control">
                                        @if(isset($users) && count($users)>0)
                                            @foreach($users as $user)
                                                <option
                                                    value="{{ $user->id }}" {{ $user->id == $nurse->user_id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <button type="submit" id="btn-update-entity" class="btn btn-primary">{{"Güncelle"}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('customJs')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $(document).ready(function () {
            $('#form-update-entity').on('submit', function (e) {
                e.preventDefault();

                let formData = $(this).serialize();
                $.ajax({
                    url: '{{route('nurse.update')}}',
                    type: 'PUT',
                    data: formData,
                    success: function (response) {
                        alert(response.message);
                        window.location.href = response.redirect;
                    },
                    error: function (response) {
                        alert(response.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endpush
