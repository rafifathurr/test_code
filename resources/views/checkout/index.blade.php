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
                    <br>
                    <br>

                    <!-- Table -->
                    <div class="table-responsive">
                        <div class="dataTables_wrapper container-fluid dt-bootstrap4">
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
                                    <table class="display table table-striped table-hover dataTable" cellspacing="0"
                                        width="100%" role="grid" aria-describedby="add-row_info"
                                        style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th width="10%">
                                                    <center>No</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Invoice</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Nama Barang</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Jumlah Pesan</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Harga Unit</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Total Harga</center>
                                                </th>
                                                <th width="15%">
                                                    <center>Action</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($checkouts as $key => $order)
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <center>{{ $key + 1 }}</center>
                                                    </td>
                                                    <td class="sorting_1">
                                                        {{ $order->invoice }}
                                                    </td>
                                                    <td class="sorting_1">
                                                        {{ $order->product->product_name }}
                                                    </td>
                                                    <td class="sorting_1">
                                                        <center>
                                                            <input type="hidden" value="{{ $order->qty }}"
                                                                id="qty_data_{{ $order->product_id }}">
                                                            <input type='number'
                                                                style='width:100px !important; height:25px !important; text-align:center;'
                                                                min=0 class='form-control' value="{{ $order->qty }}" oninput="price_update({{ $order->product_id }})"
                                                                id="qty_{{ $order->product_id }}" name="qty[]">
                                                        </center>
                                                    </td>
                                                    <td class="sorting_1" style="text-align:right;">
                                                        <input type="hidden" value='{{ $order->price }}' name="price[]"
                                                            id="price_data_{{ $order->product_id }}">
                                                        Rp. {{ number_format($order->price, 0, ',', '.') }} ,-
                                                    </td>
                                                    <td class="sorting_1">
                                                        <input type='hidden' name='total_price[]'
                                                            id="total_price_{{ $order->product_id }}">
                                                        <span id="total_price_show_{{ $order->product_id }}">Rp.
                                                            {{ number_format($order->total_price, 0, ',', '.') }}
                                                            ,-</span>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <div class="form-button-action">
                                                                <button type="submit"
                                                                    onclick="destroy({{ $order->id }})"
                                                                    data-toggle="tooltip" title="Delete"
                                                                    class="btn btn-link btn-simple-danger"
                                                                    data-original-title="Delete"
                                                                    control-id="ControlID-17">
                                                                    <i class="fa fa-trash" style="color:red;"></i>
                                                                </button>
                                                            </div>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr role="row" class="odd">
                                                <td colspan="5">
                                                    <center>Total Harga</center>
                                                </td>
                                                <td>
                                                    <input type="hidden" id="total_price_all_data" value="{{$total_price}}">
                                                    <span id="total_price_all">Rp.
                                                        {{ number_format($total_price, 0, ',', '.') }} ,-</span>
                                                </td>
                                                <td>
                                                    &nbsp;
                                                </td>
                                            </tr>
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
    function price_update(e) {

        let qty = $("#qty_" + e).val();

        let qty_data = $("#qty_data_" + e).val();

        let price = $("#price_data_" + e).val();

        if (qty == "") {
            $("#qty_" + e).val(qty_data);
            $("#total_price_" + e).val(price);
        }else{

            let result_price = price * qty;
            $("#total_price_" + e).val(result_price);
            $("#total_price_show_" + e).text("Rp. "+result_price+',-');
        }


        // GET TOTAL PRICE
        allprice();

    }

    function allprice() {

        let total_price = 0;

        $("input[name='total_price[]']").map(function() {

            let price = $(this).val();
            total_price += parseInt(price);

        });

        // CHANGING TOTAL PRICE
        $("#total_price_all_data").val(total_price);
        $("#total_price_all").text("Rp. "+total_price+',-');

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
                $.post("{{ route('user.checkout.delete') }}", {
                        id: id,
                        _token: token
                    }, function(data) {
                        location.reload();
                    })
            } else {
                return false;
            }
        });
    }
</script>

@include('layouts.swal')

</html>
