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
                <section class="content container-fluid">
                    <section class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form id="form_add" action="{{ route('admin.product.' . $url) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-12">Kode Barang <span
                                                    style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                    autocomplete="off"
                                                    @isset($products) value="{{ $products->id }}" readonly @endisset
                                                    required>
                                                <input type="text" name="code_product" id="code_product "
                                                    class="form-control" step="1"
                                                    @if (isset($products)) value="{{ $products->code_product }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-12">Nama Barang <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="product_name" id="product_name " class="form-control"
                                                    step="1" @if (isset($products)) value="{{ $products->product_name }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Kategori <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select class="form-control selectpicker" id="category"
                                                    name="category" data-size="8" data-show-subtext="true"
                                                    data-live-search="true" @if (isset($products)) @endisset autocomplete="off" required {{ $disabled_ }}>
                                                    <option value="" selected disabled hidden>- Select Category -</option>
                                                    @foreach ($categories as $cat)
                                                        <option  @if (isset($products)) <?php if ($products->category_id == $cat->id) {
                                                            echo 'selected';
                                                        } ?> @endisset value="{{ $cat->id }}">{{ $cat->category }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Harga <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="price" id="price" class="form-control numeric"
                                                    step="1" @if (isset($products)) value="{{ $products->price }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12">Jumlah Stok <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="number" name="stock" id="stock" class="form-control"
                                                    step="1" @if (isset($products)) value="{{ $products->stock }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-12">Upload Foto </span></label>
                                            <div class="col-md-12">
                                                @if ($title == 'Add Products' || $title == 'Edit Products')
                                                    <input type="file" onchange="readURL(this)" id="uploads" name="uploads" class="form-control"
                                                        accept="image/png, image/jpg, image/jpeg">
                                                    <br>
                                                    <img id="img" src="#" style="display:none;" />
                                                    <br>
                                                    @if (isset($products))
                                                        @if ($products->upload != null)
                                                            <a href="{{ url('/') . '/Uploads/Product/' . $products->upload }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> &nbsp;{{ $products->upload }} </a>
                                                            <br>
                                                            <span style="font-size: 13px;color: red">*) .png .jpg .jpeg</span>
                                                        @else
                                                            <span style="font-size: 13px;color: red">*) .png .jpg .jpeg</span> @endif
                                                @else <span style="font-size: 13px;color: red">*) .png .jpg
                                                .jpeg</span>
                                                @endif
                                            @else
                                                @if (isset($products))
                                                    @if ($products->upload != null)
                                                        <?php
                                                        $newtext = wordwrap($products->upload, 50, '<br>', true);
                                                        $namafile = "$newtext<br>";
                                                        $explode = explode('_', $products->upload);
                                                        $changename = str_replace($explode[0] . '_', '', $products->upload);
                                                        ?>
                                                        <a href="{{ url('/') . '/Uploads/Product/' . $products->upload }}"
                                                            target="_blank"><i class="fa fa-download"
                                                                aria-hidden="true"></i> &nbsp;<?php echo $changename; ?>
                                                        </a><br>
                                                    @else
                                                        <span style="font-size: 13px;color: red">*) .png .jpg
                                                            .jpeg</span>
                                                    @endif
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-6">
                                            <label class="col-md-12">Kapasitas (Kg) <span
                                                    style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="number" name="capacity" id="capacity"
                                                    class="form-control numeric" step="1"
                                                    @if (isset($products)) value="{{ $products->capacity }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="col-md-12">Berat Total (Kg) <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="number" name="weight_total" id="weight_total" class="form-control numeric"
                                                    step="1" @if (isset($products)) value="{{ $products->weight_total }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Tinggi (Mm) <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="number" name="height" id="height" class="form-control numeric"
                                                    step="1" @if (isset($products)) value="{{ $products->height }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="col-md-12">Lebar (Mm) <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="number" name="width" id="width" class="form-control numeric"
                                                    step="1" @if (isset($products)) value="{{ $products->width }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="col-md-12">Diameter (Mm) <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="number" name="radius" id="radius" class="form-control numeric"
                                                    step="1" @if (isset($products)) value="{{ $products->radius }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-12">Fire Rating (Lab. DinasPMK) <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="number" name="rating" id="rating " class="form-control"
                                                    step="1" @if (isset($products)) value="{{ $products->rating }}" @endisset autocomplete="off" required
                                                    {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <div style="float:right;">
                                            @if ($title == 'Add Products' || $title == 'Edit Products')
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    <a href="{{ route('admin.product.index') }}" type="button" class="btn btn-danger">
                                                        <i class="fa fa-arrow-left"></i>&nbsp;
                                                        Back
                                                    </a>
                                                    <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                        <i class="fa fa-check"></i>&nbsp;
                                                        Save
                                                    </button>
                                                </div>
                                            @else
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    <a href="{{ route('admin.product.index') }}" type="button" class="btn btn-danger">
                                                        <i class="fa fa-arrow-left"></i>&nbsp;
                                                        Back
                                                    </a>
                                                </div> @endif
                                                    </div>
                                            </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
            @include('layouts.footer')
            <script>
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#img').css("display", "block");
                            $('#img')
                                .attr('src', e.target.result)
                                .width(500)
                                .height(200);
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>
        </div>
    </div>
</body>

</html>
