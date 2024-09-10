@extends('admin.layout.app')
@section('title','Dashboard')
@section('body')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Dashboard</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    @if(session('message'))
        <p class="alert alert-success text-center" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">{{session('message')}}</p>
    @endif
    <!-- ROW-1 -->

    <div class="row">
        <div class="col-lg-3 col-sm-12 col-md-3 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="mb-2 text-center fw-semibold">0</h3>
                            <p class="text-muted text-center fs-13 mb-0">Credits</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-primary dash ms-auto">
                                <i class="fa-solid text-white fa-coins"></i>
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
                            <h3 class="mb-2 text-center fw-semibold">0</h3>
                            <p class="text-muted text-center fs-13 mb-0">Used Credit</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-secondary dash ms-auto">
                                <i class="fa-solid text-white fa-coins"></i>
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
                            <h3 class="mb-2 text-center fw-semibold">0</h3>
                            <p class="text-muted text-center fs-13 mb-0">Total Downloads</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-primary dash ms-auto">
                                <i class="fa-solid text-white fa-download"></i>
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
                            <h3 class="mb-2 text-center fw-semibold">0</h3>
                            <p class="text-muted text-center fs-13 mb-0">Total Phone Number</p>
                        </div>
                        <div class="col col-auto top-icn dash">
                            <div class="counter-icon bg-secondary dash ms-auto">
                                <i class="fa-solid text-white fa-phone-volume"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card product-sales-main">
                <div class="card-header border-bottom">
                    <h3 class="card-title mb-0">Billing History</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table text-nowrap mb-0 table-bordered table-striped">
                            <thead class="table-head">
                            <tr class="fw-bold bg-primary text-center">
                                <th>Invoice ID</th>
                                <th>Price Amount</th>
                                <th>Total Credit</th>
                                <th>Total Phone</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody class="table-body">
                           {{-- @forelse($planOrders as $planOrder)
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
                            @empty--}}
                                <tr class="text-center">
                                    <td class="text-danger" colspan="5">No Order Found</td>
                                </tr>
{{--                            @endforelse--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>
@endsection
