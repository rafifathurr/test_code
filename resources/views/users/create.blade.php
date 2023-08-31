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
                                <h2 class="text-white pb-2 fw-bold">{{$title}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content container-fluid">
                    <section class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">

                                @isset($users)

                                    @if($users->role_id == 1)

                                    <form id="form_add" action="{{ route('admin.users.' . $url) }}" method="post" enctype="multipart/form-data" >
                                        {{ csrf_field() }}
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Nama <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="name" id="name" class="form-control"  step="1" @if (isset($users)) value="{{ $users->name }}" @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">No Telephone <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="phone" id="phone" class="form-control"  step="1" @if (isset($users)) value="{{ $users->phone }}" @else value="{{ old('phone') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Email <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="email" name="email" id="email" class="form-control"  step="1" @if (isset($users)) value="{{ $users->email }}" @else value="{{ old('email') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Username <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="hidden" class="form-control" id="id" name="id" autocomplete="off" @isset($users) value="{{ $users->id }}" readonly @endisset required>
                                                    <input type="hidden" class="form-control" id="role" name="role" autocomplete="off" @isset($users) value="{{ $users->role_id }}" readonly @endisset required>
                                                    <input type="text" name="username" id="username" class="form-control"  step="1" @if (isset($users)) value="{{ $users->username }}" @else value="{{ old('username') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        @if ($title == 'Edit User')
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Password <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="password" name="password" id="password" class="form-control"  step="1" autocomplete="off" @if($title != "Edit User") required @endif {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        @endif
                                        <div class="modal-footer">
                                            <div style="float:right;">
                                                @if ($title == 'Edit User')
                                                    <div class="col-md-10" style="margin-right: 20px;">
                                                        <a href="{{ route('admin.users.index')}}" type="button" class="btn btn-danger">
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
                                                        <a href="{{ route('admin.users.index')}}" type="button" class="btn btn-danger">
                                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                                            Back
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </form>

                                    @else

                                    <form id="form_add" action="{{ route('admin.users.' . $url) }}" method="post" enctype="multipart/form-data" >
                                        {{ csrf_field() }}
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Nama Customer <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="name" id="name" class="form-control"  step="1" @if (isset($users)) value="{{ $users->name }}" @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">No Telephone <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="phone" id="phone" class="form-control"  step="1" @if (isset($users)) value="{{ $users->phone }}" @else value="{{ old('phone') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Email <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="email" name="email" id="email" class="form-control"  step="1" @if (isset($users)) value="{{ $users->email }}" @else value="{{ old('email') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Alamat <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <textarea class="form-control" name="address" id="address" rows="2" cols="10"  autocomplete="off" required {{ $disabled_ }} style="width:100%">@if (isset($users)) {{ $users->address }} @endisset</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Kota <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="city" id="city" class="form-control"  step="1" @if (isset($users)) value="{{ $users->city }}" @else value="{{ old('city') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Provinsi <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="province" id="province" class="form-control"  step="1" @if (isset($users)) value="{{ $users->province }}" @else value="{{ old('province') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Kode Pos <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="zipcode" id="zipcode" class="form-control"  step="1" @if (isset($users)) value="{{ $users->zipcode }}" @else value="{{ old('zipcode') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">No NPWP <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="npwp" id="npwp" class="form-control"  step="1" @if (isset($users)) value="{{ $users->npwp }}" @else value="{{ old('npwp') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Username <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="hidden" class="form-control" id="id" name="id" autocomplete="off" @isset($users) value="{{ $users->id }}" readonly @endisset required>
                                                    <input type="hidden" class="form-control" id="role" name="role" autocomplete="off" @isset($users) value="{{ $users->role_id }}" readonly @endisset required>
                                                    <input type="text" name="username" id="username" class="form-control"  step="1" @if (isset($users)) value="{{ $users->username }}" @else value="{{ old('username') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        @if ($title == 'Edit User')
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Password <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="password" name="password" id="password" class="form-control"  step="1" autocomplete="off" @if($title != "Edit User") required @endif {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        @endif
                                        <input type="hidden" id="role" name="role" @if (isset($users)) value="{{ $users->role_id }}" @else value="2"  @endisset>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Total Discount <span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="total_discount" id="total_discount" class="form-control numeric"  step="1" @if (isset($users)) value="{{ $users->total_discount }}" @else value="{{ old('total_discount') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-11">
                                                <label class="col-md-6">Credit Limit Transaksi<span style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="text" name="credit_limit" id="credit_limit" class="form-control numeric"  step="1" @if (isset($users)) value="{{ $users->credit_limit }}" @else value="{{ old('credit_limit') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal-footer">
                                            <div style="float:right;">
                                                @if ($title == 'Edit User')
                                                    <div class="col-md-10" style="margin-right: 20px;">
                                                        <a href="{{ route('admin.users.index')}}" type="button" class="btn btn-danger">
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
                                                        <a href="{{ route('admin.users.index')}}" type="button" class="btn btn-danger">
                                                            <i class="fa fa-arrow-left"></i>&nbsp;
                                                            Back
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </form>

                                    @endif

                                @else

                                <form id="form_add" action="{{ route('admin.users.' . $url) }}" method="post" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Nama Customer <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="name" id="name" class="form-control"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">No Telephone <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="phone" id="phone" class="form-control"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Email <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="email" name="email" id="email" class="form-control"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Alamat <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="address" id="address" rows="2" cols="10"  autocomplete="off" required style="width:100%"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Kota <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="city" id="city" class="form-control"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Provinsi <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="province" id="province" class="form-control"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Kode Pos <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="zipcode" id="zipcode" class="form-control"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">No NPWP <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="npwp" id="npwp" class="form-control"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Username <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="username" id="username" class="form-control"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Password <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="password" name="password" id="password" class="form-control"  step="1" autocomplete="off" style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <input type="hidden" id="role" name="role" @if (isset($users)) value="{{ $users->role_id }}" @else value="2"  @endisset>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Total Discount <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="total_discount" id="total_discount" class="form-control numeric"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Credit Limit Transaksi<span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="credit_limit" id="credit_limit" class="form-control numeric"  step="1" autocomplete="off" required style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <div style="float:right;">
                                            <div class="col-md-10" style="margin-right: 20px;">
                                                <a href="{{ route('admin.users.index')}}" type="button" class="btn btn-danger">
                                                    <i class="fa fa-arrow-left"></i>&nbsp;
                                                    Back
                                                </a>
                                                <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                    <i class="fa fa-check"></i>&nbsp;
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @endif

                            </div>
                        </div>
                    </section>
                </section>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</body>
@include('layouts.swal')
</html>
