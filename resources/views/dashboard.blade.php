<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
    @csrf
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">{{$title}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title"><strong>Month Income of {{date('Y')}}</strong> </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="min-height: 375px">
                                        <canvas id="statisticsChart"></canvas>
                                    </div>
                                    <div id="myChartLegend"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Top Sales Products</div>
                                </div>
                                <div class="card-body pb-0">
                                    @isset($topproduct)
                                @foreach($topproduct as $tp)
                                    <div class="d-flex">
                                        <div class="flex-1 pt-1 ml-2">
                                            <h6 class="fw-bold mb-1">{{$tp->product_name}}</h6>
                                        </div>
                                        <div class="d-flex ml-auto align-items-center">
                                            <h3 class="text-info fw-bold" style="color:rgb(12, 175, 12) !important;">+{{$tp->total}}</h3>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                @endforeach
                                @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
                
            </div>
        </div>
    </div>
</body>

</html>
