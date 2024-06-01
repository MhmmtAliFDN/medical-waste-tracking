@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{request()->segment(1)}}</h4>
                    @role('doctor|nurse')
                    <a href="{{route('medical-waste.add')}}" class="btn btn-rounded btn-primary">
                        <span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i></span>{{"Yeni
                        Ekle"}}
                    </a>
                    @endrole

                    @role('manager')
                    <button type="button" id="refresh-system" class="btn btn-rounded btn-info">
                        <span class="btn-icon-left text-dark"><i class="icon-refresh icons"></i></span>{{"Sistemi
                        Güncelle"}}
                    </button>
                    @endrole
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm text-dark">
                            <thead>
                            <tr>
                                <th>{{"TIBBİ ATIK ID"}}</th>
                                <th>{{"ATIK SAHİBİ"}}</th>
                                <th>{{"ATIK TÜRÜ"}}</th>
                                <th>{{"MİKTAR"}}</th>
                                <th>{{"DURUM"}}</th>
                                <th>{{"KAYIT TARİHİ"}}</th>
                                @role('doctor|nurse')
                                <th>{{"AKSİYONLAR"}}</th>
                                @endrole
                            </tr>
                            </thead>
                            @include('partials.medical-waste-table', ['medicalWastes' => $medicalWastes])
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @role('manager|waste collection staff')
    <div class="row">
        <div class="col-lg-4">
            <div class="card text-white text-center">
                <div class="card-header bg-dark">
                    <h5 class="card-title text-white">{{"TOPLANMASI GEREKEN ATIK MİKTARI"}}</h5>
                </div>
                <div class="card-body mb-0 {{ $totalUncollectedMedicalWaste > 85 ? 'bg-danger' : 'bg-primary' }}">
                    <p class="card-text">{{"Doluluk oranı: ".$totalUncollectedMedicalWaste."/100"}}</p>

                    @role('waste collection staff')
                    <button type="button" class="btn btn-dark btn-card" id="empty-container">
                        {{"Konteyneri Boşalt"}}</button>
                    @endrole
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection

@push('customJs')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        $(document).ready(function () {
            $(document).on('click', '#btn-delete-entity', function (e) {
                e.preventDefault();

                let entityId = $(this).closest('tr').attr('itemid');
                if (confirm('Bu ögeyi silmek istediğinize emin misiniz?')) {
                    $.ajax({
                        url: '{{route('medical-waste.destroy')}}',
                        type: 'DELETE',
                        data: {id: entityId},
                        success: function (response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function (xhr) {
                            let errorMessage = xhr.responseJSON.error;
                            alert(errorMessage);
                        }
                    });
                } else {
                    alert('Silme işlemi iptal edildi.');
                }
            });

            $(document).on('click', '#empty-container', function () {
                if (confirm('Konteyneri boşaltmak istediğinize emin misiniz?')) {
                    $.ajax({
                        url: '{{ route('medical-waste.emptyMedicalWaste') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function (xhr) {
                            alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                        }
                    });
                }
            });

            $(document).on('click', '#refresh-system', function () {
                $.ajax({
                    url: '{{route('medical-waste.refreshSystem')}}',
                    type: 'GET',
                    success: function (response) {
                        $('table.table-hover tbody').html(response);
                    },
                    error: function (xhr) {
                        alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                    }
                });
            });
        });
    </script>
@endpush
