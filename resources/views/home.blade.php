@extends('layouts.admin_layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">

        <div class="container-fluid">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Suara Caleg per TPS
                    </div>

                    <div class="card-body">
                        <canvas id="suarapertps"></canvas>
                    </div>
                </div><!-- end card-->
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Suara Caleg per Dapil
                        </div>

                        <div class="card-body">
                            <canvas id="suaraperdapil"></canvas>
                        </div>
                    </div><!-- end card-->
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Suara Partai per TPS:
                            @isset($tampilnamatps->nama_tps)
                                {{ $tampilnamatps->nama_tps }}
                            @endisset
                        </div>
                        <div class="mx-auto mt-2">
                            <form action="/home" method="POST" class="mx-auto">
                                @csrf
                                <select class="form-control select2" id="pilihtps" name="pilihtps">
                                    @foreach ($listtps as $key => $option)
                                        <option value="{{ $option->id }}">{{ $option->nama_tps }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-primary mt-1">
                            </form>
                        </div>

                        <div class="card-body">
                            <canvas id="suarapartaipertps"></canvas>
                        </div>
                    </div><!-- end card-->
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Suara Partai per Dapil
                            @isset($tampilnamadapil->nama_dapil)
                                {{ $tampilnamadapil->nama_dapil }}
                            @endisset
                        </div>
                        <div class="mx-auto mt-2">
                            <form action="/home" method="POST" class="mx-auto">
                                @csrf
                                <select class="form-control select2" id="pilihdapil" name="pilihdapil">
                                    @foreach ($listdapil as $key => $option)
                                        <option value="{{ $option->id }}">{{ $option->nama_dapil }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-primary mt-1">
                            </form>
                        </div>

                        <div class="card-body">
                            <canvas id="suarapartaiperdapil"></canvas>
                        </div>
                    </div><!-- end card-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $('#pilihtps').on('change', function() {
                var selectedValue = $(this).val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                // Send the selected value to the controller using AJAX
                $.ajax({
                    type: 'POST',
                    url: '/update-partai-tps', // Use the correct URL
                    data: {
                        pilihtps: selectedValue
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
                    },
                    success: function(response) {
                        // Handle the response from the controller (if needed)
                        console.log('Response from controller:', response);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Handle any errors that occur during the AJAX request
                        console.error('Error:', errorThrown);
                    }
                });
            });
        });
    </script> --}}
    <script>
        // pieChart
        const backgroundColor = [];
        const borderColor = [];
        for (i = 0; i < 12; i++) {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            backgroundColor.push('rgba(' + r + ',' + g + ',' + b + ', 0.2)');
            borderColor.push('rgba(' + r + ',' + g + ',' + b + ', 1)');
        }
        // barChart
        var ctx1 = document.getElementById("suarapertps").getContext('2d');
        var barChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelspertps) !!},
                datasets: [{
                    label: 'Amount received',
                    data: {!! json_encode($datapertps) !!},
                    backgroundColor: backgroundColor,
                    borderColor: borderColor,
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

        var ctx2 = document.getElementById("suaraperdapil").getContext('2d');
        var pieChart = new Chart(ctx2, {
            type: 'pie',
            data: {
                datasets: [{
                    data: {!! json_encode($dataperdapil) !!},
                    backgroundColor: backgroundColor,
                    label: 'Dataset 1'
                }],
                labels: {!! json_encode($labelsperdapil) !!}
            },
            options: {
                responsive: true
            }

        });

        var ctx3 = document.getElementById("suarapartaipertps").getContext('2d');
        var pieChart = new Chart(ctx3, {
            type: 'pie',
            data: {
                datasets: [{
                    data: {!! json_encode($datapartaipertps) !!},
                    backgroundColor: backgroundColor,
                    label: 'Dataset 1'
                }],
                labels: {!! json_encode($labelspartaipertps) !!}
            },
            options: {
                responsive: true
            }

        });
        var ctx4 = document.getElementById("suarapartaiperdapil").getContext('2d');
        var pieChart = new Chart(ctx4, {
            type: 'pie',
            data: {
                datasets: [{
                    data: {!! json_encode($datapartaiperdapil) !!},
                    backgroundColor: backgroundColor,
                    label: 'Dataset 1'
                }],
                labels: {!! json_encode($labelspartaiperdapil) !!}
            },
            options: {
                responsive: true
            }

        });
    </script>
@endsection
