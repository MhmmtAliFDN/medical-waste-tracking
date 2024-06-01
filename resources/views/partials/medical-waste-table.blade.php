@foreach($medicalWastes as $medicalWaste)
    <tr itemid="{{$medicalWaste->id}}">
        <td>{{$medicalWaste->id}}</td>
        <td>{{$medicalWaste->created_by->user->name . " (" . $medicalWaste->created_by_type .")" }}</td>
        <td>{{$medicalWaste->waste_type}}</td>
        <td>{{$medicalWaste->waste_quantity}}</td>
        <td>{{$medicalWaste->status}}</td>
        <td>{{ date('j.m.Y', strtotime($medicalWaste->created_at)) }}
        </td>
        <td>
            @role('doctor|nurse')
            <span>
                <a type="button"
                   href="{{route('medical-waste.edit', ['id' => $medicalWaste->id])}}"
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
            @endrole
        </td>
    </tr>
@endforeach
