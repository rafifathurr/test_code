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
                                <form id="form_add" action="{{ route('user.product.' . $url) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <input type="hidden" class="form-control" id="id" name="id"
                                                    autocomplete="off"
                                                    @isset($products) value="{{ $products->id }}" readonly @endisset
                                                    required>
                                                <img src="{{ asset('Uploads/Product/' . $products->upload) }}"
                                                    style="padding:20px;" width="50%" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <label class="col-md-12">Kode Barang <span
                                                        style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="code_product" id="code_product "
                                                        class="form-control" step="1" @if (isset($products))
                                                value="{{ $products->code_product }}" @endisset autocomplete="off"
                                                required
                                                {{ $disabled_ }} style="width:100%;" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="col-md-12">Nama Barang <span
                                                    style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="product_name" id="product_name "
                                                    class="form-control" step="1" @if (isset($products))
                                            value="{{ $products->product_name }}" @endisset autocomplete="off"
                                            required
                                            {{ $disabled_ }} style="width:100%;" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-12">Harga Barang <span
                                                style="color: red;">*</span></label>
                                        <div class="col-md-12">
                                            <input type="hidden" name="price_data" id="price_data" @if (isset($products))
                                        value="{{ $products->price }}" @endisset>
                                        <input type="text" name="price" id="price"
                                            class="form-control numeric" step="1" @if (isset($products))
                                    value="{{ $products->price }}" @endisset autocomplete="off"
                                    required
                                    {{ $disabled_ }} style="width:100%;" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-12">Jumlah Pesanan <span
                                        style="color: red;">*</span></label>
                                <div class="col-md-12">
                                    <input type="number" name="qty" id="qty"
                                        oninput="price_update(this)" class="form-control" step="1"
                                        min="0" max={{ $products->stock }} autocomplete="off"
                                        required {{ $disabled_ }} style="width:100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <div style="float:right;">
                            <div class="col-md-10" style="margin-right: 20px;">
                                <a href="{{ route('user.product.index') }}" type="button"
                                    class="btn btn-danger">
                                    <i class="fa fa-arrow-left"></i>&nbsp;
                                    Back
                                </a>
                                <button type="submit" class="btn btn-primary"
                                    style="margin-left:10px;">
                                    <i class="fa fa-check"></i>&nbsp;
                                    Save
                                </button>
                            </div>
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

    function price_update(value) {

        let qty = value.value;
        let price = $("#price_data").val();

        if (qty == "") {
            $("#qty").val(1)
            $("#price").val(price);
            $("#price").inputmask({
                alias: "numeric",
                prefix: "Rp.",
                digits: 0,
                repeat: 20,
                digitsOptional: false,
                decimalProtect: true,
                groupSeparator: ".",
                placeholder: '0',
                radixPoint: ",",
                radixFocus: true,
                autoGroup: true,
                autoUnmask: false,
                clearMaskOnLostFocus: false,
                onBeforeMask: function(value, opts) {
                    return value;
                },
                removeMaskOnSubmit: true
            });
        } else {
            let total_harga = price * qty;

            $("#price").val(total_harga);
            $("#price").inputmask({
                alias: "numeric",
                prefix: "Rp.",
                digits: 0,
                repeat: 20,
                digitsOptional: false,
                decimalProtect: true,
                groupSeparator: ".",
                placeholder: '0',
                radixPoint: ",",
                radixFocus: true,
                autoGroup: true,
                autoUnmask: false,
                clearMaskOnLostFocus: false,
                onBeforeMask: function(value, opts) {
                    return value;
                },
                removeMaskOnSubmit: true
            });
        }
    }
</script>
</div>
</div>
</body>

</html>
