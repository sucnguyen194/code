<div class="modal-dialog modal-lg" role="document">
    <form action="{{route('admin.alias.store')}}" method="post" class="ajax-form" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Module | {{$module->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <table id="datatable-buttons" class="table table-hover bs-table" style="border-collapse: collapse; border-spacing: 0; ;">
                    <thead>
                    <tr>
                        <th>Tên cột</th>
                        <th style="width: 30%">Tên hiển thị</th>
                        <th style="width: 30%">Kiểu hiển thị</th>
                        <th>Kiểu dữ liệu</th>
                        <th>Độ dài</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach(json_decode($module->fields) as $field)
                        <tr>
                            <td >{{$field->name}}</td>
                            <td>{{$field->display_name}}</td>
                            <td>
                                @switch($field->display_type)
                                    @case(0)
                                    Text
                                    @break
                                    @case(1)
                                    Checkbox
                                    @break
                                    @case(2)
                                    Number
                                    @break
                                    @case(3)
                                    Radio
                                    @break
                                    @case(4)
                                    Select
                                    @break
                                    @case(5)
                                    File
                                    @break

                                    @default
                                    Textarea
                                @endswitch

                            </td>
                            <td>
                                @switch($field->type)
                                    @case(0)
                                    Text
                                    @break
                                    @case(1)
                                    Integer
                                    @break
                                    @case(2)
                                    Varchar
                                    @break
                                    @case(3)
                                    Text
                                    @break
                                    @default
                                    Date
                                @endswitch
                            </td>
                            <td>{{$field->length}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại
                </button>
            </div>
        </div>
    </form>
</div>
