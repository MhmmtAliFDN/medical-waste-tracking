@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{request()->segment(1)}}</h4>
                    @role('authorized officer')
                    <a href="{{route('report.add')}}" class="btn btn-rounded btn-primary">
                        <span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i></span>Yeni
                        Ekle
                    </a>
                    @endrole
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm text-dark">
                            <thead>
                            <tr>
                                <th>RAPOR ID</th>
                                <th>YETKİLİ MEMUR ADI</th>
                                <th>BAŞLIK</th>
                                <th>İÇERİK</th>
                                <th>KAYIT TARİHİ</th>
                                @role('manager')
                                <th>AKSİYONLAR</th>
                                @endrole
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reports as $report)
                                <tr itemid="{{$report->id}}">
                                    <td>{{$report->id}}</td>
                                    <td>{{$report->user->name}}</td>
                                    <td>{{$report->title}}</td>
                                    <td>{{$report->content}}</td>
                                    <td>{{ date('j.m.Y', strtotime($report->created_at)) }}
                                    </td>
                                    <td>
                                        <span class="button-container">
                                            @role('manager|authorized officer')
                                            <a type="button" href="{{asset($report->content)}}" target="_blank"
                                               class="btn btn-rounded btn-info mx-1" data-toggle="tooltip"
                                               data-placement="top" title="İncele">
                                                    <i class="icon-size-fullscreen icons color-primary"></i>
                                            </a>
                                            @endrole

                                            @role('manager')
                                            <a type="button" href="{{route('report.edit', ['id' => $report->id])}}"
                                               class="btn btn-rounded btn-primary mx-1" data-toggle="tooltip"
                                               data-placement="top" title="Düzenle">
                                                    <i class="fa fa-pencil fa-lg color-primary"></i>
                                            </a>

                                            <button type="button" id="btn-delete-entity"
                                                    class="btn btn-rounded btn-danger mx-1" data-toggle="tooltip"
                                                    data-placement="top" title="Sil">
                                                    <i class="fa fa-trash fa-lg color-danger"></i>
                                            </button>
                                            @endrole
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
        })

        $(document).ready(function () {
            $(document).on('click', '#btn-delete-entity', function (e) {
                e.preventDefault();

                let entityId = $(this).closest('tr').attr('itemid');
                if (confirm('Bu ögeyi silmek istediğinize emin misiniz?')) {
                    $.ajax({
                        url: '{{route('report.destroy')}}',
                        type: 'DELETE',
                        data: {id: entityId},
                        success: function (response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function (response) {
                            alert(response.message);
                        }
                    });
                } else {
                    alert('Silme işlemi iptal edildi.');
                }
            });
        });
    </script>
@endpush

@push('customCss')
    <style>
        .button-container {
            display: flex;
            align-items: center; /* Aligns buttons vertically */
        }
    </style>
@endpush
