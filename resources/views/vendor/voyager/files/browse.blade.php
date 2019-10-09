@section('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

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
            <i class="fas fa-file-excel"></i> Fichiers Excels
        </h1>

            <a href="{{route('UploadFiles')}}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>Créer un nouveau Fichier</span>
            </a>
            <a id="#compare" onclick="return buildURL()" href="" class="btn btn-info btn-add-new">
                <i class="voyager-pie-chart"></i> <span>Comparer</span>
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

                                    <h3 class="box-title">Liste des fichiers mis en ligne</h3>

                            </div>

                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="tickets" class="table table-bordered table-striped">
                                    <thead>



                                    <tr>
                                        <th>Selectionner</th>
                                        <th>ID Fichier</th>

                                        <th>Nom fichier</th>
                                        <th>Crée le</th>
                                        <th>Mise en ligne par</th>
                                        <th>Taille</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($files as $file)

                                        <tr>
                                            <td>
                                                <input type="checkbox" value=" {{$file->id}}" id={{$file->id}}>
                                            </td>   <td>
                                                {{"XLS : ".$file->id}}
                                            </td>
                                            <!--- ID -->

                                            <td>
                                                {{$file->filename}}
                                            </td>

                                            <td>{{$file->created_at}}</td>
                                            <td>
                                                <?php
                                                $uploaderName = App\User::Where('id',"=",$file->id_uploader)->pluck('email');
                                                echo $uploaderName;
                                                ?>
                                            </td>
                                            <td> {{ number_format((float)$file->filesize, 2, '.', '')}} (KB)</td>

                                            <td><a class="btn btn-info" href="{{route('showFile',[$file->id])}}">Afficher le contenu</a>
                                                <a class="btn btn-danger" onclick="return confirm('Are you sure?')" href="{{route('deleteFile',[$file->id])}}" class="text-danger"> <i class="fas fa-trash"></i>Supprimer </a>

                                            </td>
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
<script>

    function buildURL() {
       var  numberChk = document.querySelectorAll('input[type="checkbox"]:checked').length;
        if  (numberChk > 2) {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'veillez choissiez 2 fichiers au maximum.',
            })
            return false;

        }
          else if  (numberChk <2) {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'veillez choissiez 2 fichiers si\'il vous plait',
            })
            return false;
        }
          else {

            var file1 = document.querySelectorAll('input[type="checkbox"]:checked')[0].id;
            var file2 = document.querySelectorAll('input[type="checkbox"]:checked')[1].id;


            var generatedURL = "/"+file1+"/"+file2;
            window.open(window.location.href+"/comparefiles"+generatedURL);

        }

    }

</script>


@section('js')
    <!-- DataTables -->
    <script src="{{{asset('js/jquery.dataTables.min.js')}}}"></script>
    <script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('js/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('js/demo.js')}}"></script>
    <!-- page script -->
    <script>

    </script>
@endsection

