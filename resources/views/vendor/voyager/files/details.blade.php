@section('css')

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <script src="https://kit.fontawesome.com/7639016bd7.js"></script>

@endsection


@extends('voyager::master')


@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="fas fa-file-excel"></i>Details Fichier
        </h1>

        <a href="{{route('UploadFiles')}}" class="btn btn-success btn-add-new">
            <i class="voyager-plus"></i> <span>Créer un nouveau Fichier</span>
        </a>
    </div>
@stop

@section('content')

    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                        <div class="box">
                            <div class="box-header">

                                <h3 class="box-title">Details Fichier</h3>

                            </div>

                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="tickets" class="table table-bordered table-striped">
                                    <thead>



                                    <tr>
                                        <th>DAT_MaterialNumber</th>
                                        <th>DAT_RemainOrderQty</th>
                                        <th>DAT_Revesion_level</th>
                                        <th>DAT_work_center</th>
                                        <th>DAT_Released_On</th>
                                        <th>DAT_Relased_by</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($filedetials as $file)

                                        <tr>
                                            <td>
                                                {{$file->DAT_MaterialNumber}}
                                            </td>
                                            <td>
                                                {{$file->DAT_RemainOrderQty}}
                                            </td>
                                            <!--- ID -->

                                            <td>
                                                {{$file->DAT_Revesion_level}}
                                            </td>

                                            <td>{{$file->DAT_work_center}}</td>
                                            <td>
                                               {{$file->DAT_Released_On}}
                                            </td>
                                            <td> {{$file->DAT_Relased_by}}</td>

                                        </tr>
                                    @endforeach



                                    </tbody>



                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
@stop
