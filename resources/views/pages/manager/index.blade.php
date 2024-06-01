@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{request()->segment(1)}}</h4>
                    <a href="{{route('manager.add')}}" class="btn btn-rounded btn-primary">
                        <span class="btn-icon-left text-primary"><i class="fa fa-plus color-primary"></i></span>Yeni
                        Ekle
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm text-dark">
                            <thead>
                            <tr>
                                <th>YÖNETİCİ ID</th>
                                <th>KULLANICI ADI</th>
                                <th>KAYIT TARİHİ</th>
                                <th>AKSİYONLAR</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($managers as $manager)
                                <tr itemid="{{$manager->id}}">
                                    <td>{{$manager->id}}</td>
                                    <td>{{$manager->user->name}}</td>
                                    <td>{{ date('j.m.Y', strtotime($manager->created_at)) }}
                                    </td>
                                    <td>
                                        <span>
                                            <a type="button" href="{{route('manager.edit', ['id' => $manager->id])}}"
                                               class="btn btn-rounded btn-primary mx-2" data-toggle="tooltip"
                                               data-placement="top" title="Düzenle">
                                                    <i class="fa fa-pencil fa-lg color-primary"></i>
                                            </a>

                                            <button type="button" id="btn-delete-entity"
                                                    class="btn btn-rounded btn-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Sil">
                                                    <i class="fa fa-trash fa-lg color-danger"></i>
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /# card -->
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
                        url: '{{route('manager.destroy')}}',
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
