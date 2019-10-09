@section('css')



    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <script src="https://kit.fontawesome.com/7639016bd7.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
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

                                <h3 class="box-title">Comparateur entre Fichier {{$fDetials1[0]->id}} et {{$fDetials2[0]->id}}</h3>

                            </div>

                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="file1"  class="table table-bordered table-striped table-responsive">
                                    <thead>
                                    <tr>
                                       <th style="vertical-align: center;text-align: center" colspan="6">Fichier {{$fDetials1[0]->id}}</th>
                                    </tr>



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
                                    <?php $mNumber1 = array();
                                    ?>
                                    @foreach($fDetials1 as $file)


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
                                    <?php
                                        $tempArray= array(
                                          'DAT_MaterialNumber'=>$file->DAT_MaterialNumber,
                                          'DAT_RemainOrderQty'=>$file->DAT_RemainOrderQty
                                    );
                                    array_push($mNumber1,$tempArray);

                                      ?>
                                    @endforeach



                                    </tbody>



                                </table>
                                <pre>
                                </pre>

                                <table  id="file2" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th style="vertical-align: center;text-align: center" colspan="6"> Fichier {{$fDetials2[0]->id}}</th>
                                    </tr>



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

                                    <?php $mNumber2 = array();
                                    ?>
                                    @foreach($fDetials2 as $file)


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
                                            <?php
                                            $mn = $file->DAT_MaterialNumber;


                                            $tempArray2 = array();
                                            for($index=0;$index<count($mNumber1);$index++) {
                                                if ($mNumber1[$index]['DAT_MaterialNumber'] == $mn ){
                                                    $tempArray2= array(
                                                        'DAT_MaterialNumber'=>$file->DAT_MaterialNumber,
                                                        'DAT_RemainOrderQty'=>$file->DAT_RemainOrderQty

                                                    );
                                                    array_push($mNumber2,$tempArray2);


                                                }
                                            }


                                      ?>

                                    @endforeach



                                    </tbody>



                                </table>
                                <pre>

                                </pre>



                            </div>





                            <div class="col-lg-6">
                                <table  id="file2" class="table table-bordered table-striped table-responsive">

                                    <tr>
                                        <td colspan="4" class="text-center">Difference</td>
                                    </tr>

                                    <tr>
                                        <td>DAT_MaterialNumber</td>
                                        <td>File1</td>
                                        <td>File2</td>
                                        <td>Delta</td>

                                    </tr>
                                    @for($index=0;$index<count($mNumber2);$index++)

                                    <tr>
                                             <td>{{($mNumber2[$index]['DAT_MaterialNumber'])}}</td>
                                             <td>{{($mNumber1[$index]['DAT_RemainOrderQty'])}}</td>
                                             <td>{{($mNumber2[$index]['DAT_RemainOrderQty'])}}</td>
                                             <td>{{($mNumber2[$index]['DAT_RemainOrderQty'])-($mNumber1[$index]['DAT_RemainOrderQty'])}}</td>

                                            </tr>

                                        @endfor
                                </table>

                            </div>
                            <div class="col-lg-6">

                                <canvas id="myChart" width="400" height="400"></canvas>
                                <script>
                                    var ctx = document.getElementById('myChart').getContext('2d');
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [12, 19, 3, 5, 2, 3],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(153, 102, 255, 0.2)',
                                                    'rgba(255, 159, 64, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        beginAtZero: true
                                                    }
                                                }]
                                            }
                                        }
                                    });
                                </script>
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
