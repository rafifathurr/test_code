<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">{{ $title }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <!-- Button -->
                    <div class="d-flex">
                        @if (Auth::guard('admin')->check())
                            <button id="export" class="btn btn-primary btn-round ml-auto mb-3"
                                style="background-color:green !important;" href="">
                                <i class="fa fa-file-excel"></i>
                                Export Excel
                            </button>
                            <a class="btn btn-primary btn-round mb-3" style="margin-left:10px;"
                                href="{{ route('admin.order.create') }}">
                                <i class="fa fa-plus"></i>
                                Add Order
                            </a>
                        @else
                            <a class="btn btn-add btn-round ml-auto mb-3" href="{{ route('user.order.create') }}">
                                <i class="fa fa-plus"></i>
                                Add Order
                            </a>
                        @endif
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="add-row_length"></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="add-row_filter"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="add-row" class="display table table-striped table-hover dataTable"
                                        cellspacing="0" width="100%" role="grid" aria-describedby="add-row_info"
                                        style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th width="10%">
                                                    <center>No</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Receipt Number</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Date</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Time</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Type</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Total Amount</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Action</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key=>$order)
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <center>{{ $key+1 }}</center>
                                                    </td>
                                                    <td class="sorting_1">
                                                        {{ $order->receipt_number }}
                                                    </td>
                                                    <td class="sorting_1">
                                                        <center>
                                                        <?php
                                                            $time = $order->date;
                                                            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                            $pisahfix = explode("-", $time);
                                                            $blnf = $pisahfix[1] - 1;
                                                        ?>
                                                        {{$pisahfix[2] . " " . $bulan[$blnf] . " " . $pisahfix[0] . " " }}
                                                        </center>
                                                    </td>
                                                    <td class="sorting_1">
                                                        <center>{{ $order->time }}</center>
                                                    </td>
                                                    <td class="sorting_1">
                                                        <center>{{ $order->event_type }}</center>
                                                    </td>
                                                    <td class="sorting_1" style="text-align:right;">
                                                        @if($order->event_type == "Payment")
                                                            Rp. {{ number_format($order->total_amount, 0, ',', '.') }},-
                                                        @else
                                                            Rp. - {{ number_format($order->total_amount, 0, ',', '.') }},-
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <div class="form-button-action">
                                                                @if (Auth::guard('admin')->check())
                                                                    <a href="{{ route('admin.order.detail', $order->id) }}"
                                                                        data-toggle="tooltip" title="Detail"
                                                                        class="btn btn-link btn-icon btn-lg"
                                                                        data-original-title="Detail"
                                                                        control-id="ControlID-16">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    <a href="{{ route('admin.order.edit', $order->id) }}"
                                                                        data-toggle="tooltip" title="Edit"
                                                                        class="btn btn-link btn-simple-primary btn-lg"
                                                                        data-original-title="Edit"
                                                                        control-id="ControlID-16">
                                                                        <i class="fa fa-edit" style="color:grey;"></i>
                                                                    </a>
                                                                    <button type="submit"
                                                                        onclick="destroy({{ $order->id }})"
                                                                        data-toggle="tooltip" title="Delete"
                                                                        class="btn btn-link btn-simple-danger"
                                                                        data-original-title="Delete"
                                                                        control-id="ControlID-17">
                                                                        <i class="fa fa-trash" style="color:red;"></i>
                                                                    </button>
                                                                @else
                                                                    <a href="{{ route('user.order.detail', $order->id) }}"
                                                                        data-toggle="tooltip" title="Detail"
                                                                        class="btn btn-link btn-simple-primary btn-lg"
                                                                        data-original-title="Detail"
                                                                        control-id="ControlID-16">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    <a href="{{ route('user.order.edit', $order->id) }}"
                                                                        data-toggle="tooltip" title="Edit"
                                                                        class="btn btn-link btn-simple-primary btn-lg"
                                                                        data-original-title="Edit"
                                                                        control-id="ControlID-16">
                                                                        <i class="fa fa-edit" style="color:grey;"></i>
                                                                    </a>
                                                                    <button type="submit"
                                                                        onclick="destroy({{ $order->id }})"
                                                                        data-toggle="tooltip" title="Delete"
                                                                        class="btn btn-link btn-simple-danger"
                                                                        data-original-title="Delete"
                                                                        control-id="ControlID-17">
                                                                        <i class="fa fa-trash" style="color:red;"></i>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="add-row_info"></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
            <script src="{{ asset('js/app/table.js') }}"></script>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#export').on('click', function() {
            const div = document.createElement("form");
            div.method = 'POST';
            div.action = '{{ route('admin.order.export') }}';
            $(div).html(
                "<input name='_token' value='{{ csrf_token() }}' type='hidden'>" +
                "<select id='tahun' name='tahun' onchange='getMonth()' class='form-control'>" +
                "<option value='' style='display: none;' selected=''>- Choose Year -</option>" +
                "@foreach ($years as $year)" +
                "<option value='{{ $year->tahun }}'>{{ $year->tahun }}</option>" +
                "@endforeach" +
                "</select><br><br>" +
                "<select id='bulan' name='bulan' class='form-control' disabled>" +
                "<option value='' style='display: none;' selected=''>- Choose Month -</option>" +
                "</select><br>"
            );
            swal({
                title: "Export Report Order",
                content: div,
                buttons: [true, "Export"]
            }).then((result) => {
                if (result == true) {
                    if ($('#tahun').val() != '') {
                        div.submit();
                    } else {
                        swal({
                            icon: 'warning',
                            title: 'Oops !',
                            button: false,
                            text: 'Please Choose Year or Month First!',
                            timer: 1500
                        });
                    }
                }
            })
        })
    })

    function getMonth() {
        var tahun = document.getElementById("tahun").value;
        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ route('admin.order.getMonth') }}",
            type: "POST",
            data: {
                '_token': token,
                'tahun': tahun
            },
        }).done(function(result) {
            $('#bulan').empty();
            $('#bulan').removeAttr('disabled');
            $('#bulan').append($('<option>', {
                value: '0',
                text: 'All'
            }));
            $.each(JSON.parse(result), function(i, item) {
                $('#bulan').append($('<option>', {
                    value: item.bulan,
                    text: item.nama_bulan
                }));
            });
        });
    }

    function destroy(id) {
        var token = $('meta[name="csrf-token"]').attr('content');

        swal({
            title: "",
            text: "Are you sure want to delete this record?",
            icon: "warning",
            buttons: ['Cancel', 'OK'],
            // dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                @if (Auth::guard('admin')->check())
                    $.post("{{ route('admin.order.delete') }}", {
                        id: id,
                        _token: token
                    }, function(data) {
                        location.reload();
                    })
                @else
                    $.post("{{ route('user.order.delete') }}", {
                        id: id,
                        _token: token
                    }, function(data) {
                        location.reload();
                    })
                @endif
            } else {
                return false;
            }
        });
    }
</script>

@include('layouts.swal')

</html>