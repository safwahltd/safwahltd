@extends('admin.layout.app')
@section('title','Dashboard')
@section('body')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
        </div>
    </div>
   {{-- <!-- PAGE-HEADER END -->
    @if(session('message'))
        <p class="alert alert-success text-center" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">{{session('message')}}</p>
    @endif
    <!-- ROW-1 -->--}}

    <div class="row">
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalUser}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">User</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-user-group"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalCore}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Core Values</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="text-white fa fa-solid fa-wand-magic-sparkles"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalConcern}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Concern</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-c"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalMission}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Mission & Vision</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-m"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalProduct}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Product</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-p"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalArticle}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Article</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-a"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalShop}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Available Shop</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-shop"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalSocial}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Social Link</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-s"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalSlider}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Slider</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-sliders"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalRole}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Role</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-r"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">{{$totalPermission}}</h3>
                            <p class="text-muted text-center fs-13 mb-0">Permission</p>
                        </div>
                        <div class="col col-auto top-icn ">
                            <div class="counter-icon bg-dark  ms-auto">
                                <i class="fa-solid text-white fa-pen"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="row">
        <div class="col-12 col-sm-12">
            <div class="card product-sales-main">
                <div class="card-header border-bottom">
                    <h3 class="card-title mb-0">Billing History</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table text-nowrap mb-0 table-bordered table-striped">
                            <thead class="table-head">
                            <tr class="fw-bold bg-dark text-center">
                                <th>Invoice ID</th>
                                <th>Price Amount</th>
                                <th>Total Credit</th>
                                <th>Total Phone</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody class="table-body">
                           --}}{{-- @forelse($planOrders as $planOrder)
                                <tr class="text-center my-1">
                                    <td>{{$planOrder->invoice_id}}</td>
                                    <td>{{$planOrder->price_amount}}</td>
                                    <td>{{$planOrder->no_credit}}</td>
                                    <td>{{$planOrder->no_phone}}</td>
                                    <td class="my-2 {{$planOrder->payment_status == 0 ? 'text-warning fw-bold':''}}{{$planOrder->payment_status == 1 ? 'text-success':''}}{{$planOrder->payment_status == 2 ? 'text-danger fw-bold':''}}">
                                        <i class="fa {{$planOrder->payment_status == 0 ? 'fa-spinner':''}}{{$planOrder->payment_status == 1 ? 'fa-check-circle-o':''}}{{$planOrder->payment_status == 2 ? 'fa-trash':''}}"></i>
                                        {{$planOrder->payment_status == 0 ? 'Pending':''}}
                                        {{$planOrder->payment_status == 1 ? 'Approved':''}}
                                        {{$planOrder->payment_status == 2 ? 'Canceled':''}}
                                    </td>
                                </tr>
                            @empty--}}{{--
                                <tr class="text-center">
                                    <td class="text-danger" colspan="5">No Order Found</td>
                                </tr>
--}}{{--                            @endforelse--}}{{--
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>--}}
@endsection
