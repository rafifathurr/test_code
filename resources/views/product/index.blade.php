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

                {{-- ADMIN SECTION --}}
                @if (Auth::guard('admin')->check())
                <div class="page-inner mt--5">
                    <!-- Button -->
                    <div class="d-flex">
                            <a class="btn btn-primary btn-round ml-auto mb-3" href="{{ route('admin.product.create') }}">
                                <i class="fa fa-plus"></i>
                                Add Product
                            </a>
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
                                                <th class="sorting_asc" width="10%">
                                                    <center>No</center>
                                                </th>
                                                <th width="15%">
                                                    Kode Barang
                                                </th>
                                                <th width="20%">
                                                    Nama Barang
                                                </th>
                                                <th width="15%">
                                                    Kategori
                                                </th>
                                                <th width="15%">
                                                    Harga
                                                </th>
                                                <th width="15%">
                                                    Jumlah Stok
                                                </th>
                                                <th width="10%">
                                                    <center>Action</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key=>$prod)
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <center>{{ $key + 1 }}</center>
                                                    </td>
                                                    <td class="sorting_1">
                                                        {{ $prod->code_product }}
                                                    </td>
                                                    <td class="sorting_1">
                                                        {{ $prod->product_name }}
                                                    </td>
                                                    <td class="sorting_1">
                                                        {{ $prod->category->category }}
                                                    </td>
                                                    <td class="sorting_1" style="text-align:right;">
                                                        Rp. {{ number_format($prod->price, 0, ',', '.') }}
                                                    </td>
                                                    @if($prod->stock==0)
                                                    <td class="sorting_1" style="color:red;text-align:right;">
                                                        {{ $prod->stock }}
                                                    </td>
                                                    @else
                                                    <td class="sorting_1" style="text-align:right;">
                                                        {{ $prod->stock }}
                                                    </td>
                                                    @endif
                                                    <td>
                                                        <center>
                                                            <div class="form-button-action">
                                                                <a href="{{ route('admin.product.detail', $prod->id) }}"
                                                                    data-toggle="tooltip" title="Detail"
                                                                    class="btn btn-link btn-icon btn-lg"
                                                                    data-original-title="Detail"
                                                                    control-id="ControlID-16">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('admin.product.edit', $prod->id) }}"
                                                                    data-toggle="tooltip" title="Edit"
                                                                    class="btn btn-link btn-icon btn-lg"
                                                                    data-original-title="Edit"
                                                                    control-id="ControlID-16">
                                                                    <i class="fa fa-edit" style="color:grey;"></i>
                                                                </a>
                                                                <button type="submit"
                                                                    onclick="destroy({{ $prod->id }})"
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
                @else
                
                {{-- USER SECTION --}}
                <div class="page-inner mt--5">

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
                                                <th width="15%">
                                                    Kode Barang
                                                </th>
                                                <th width="20%">
                                                    Nama Barang
                                                </th>
                                                <th width="15%">
                                                    Kategori
                                                </th>
                                                <th width="15%">
                                                    Harga
                                                </th>
                                                <th width="15%">
                                                    Jumlah Stok
                                                </th>
                                                <th width="10%">
                                                    <center>Action</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $key=>$prod)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        {{ $prod->code_product }}
                                                    </td>
                                                    <td class="sorting_1">
                                                        {{ $prod->product_name }}
                                                    </td>
                                                    <td class="sorting_1">
                                                        {{ $prod->category->category }}
                                                    </td>
                                                    <td class="sorting_1" style="text-align:right;">
                                                        Rp. {{ number_format($prod->price, 0, ',', '.') }}
                                                    </td>
                                                    @if($prod->stock==0)
                                                    <td class="sorting_1" style="color:red;text-align:right;">
                                                        {{ $prod->stock }}
                                                    </td>
                                                    @else
                                                    <td class="sorting_1" style="text-align:right;">
                                                        {{ $prod->stock }}
                                                    </td>
                                                    @endif
                                                    <td>
                                                        <center>
                                                            <div class="form-button-action">
                                                                <a href=""
                                                                    data-toggle="tooltip" title="Detail"
                                                                    class="btn btn-link btn-icon btn-lg"
                                                                    data-original-title="Pesan Barang"
                                                                    control-id="ControlID-16">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                </a>
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

                @endif

                
            </div>
            @include('layouts.footer')
            <script src="{{ asset('js/app/table.js') }}"></script>
        </div>
    </div>
</body>
<script>
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
                    $.post("{{ route('admin.product.delete') }}", {
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
