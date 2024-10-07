@extends('admin.layout.app')
@section('title','Password Change')
@section('body')
    <div class="row row-sm mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{route('admin.pass.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center mb-4">
                            <div class="col-md-8 mx-0">
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="company_name">Current Password</span>
                                        <input type="password" name="old_password" class="form-control" value="" placeholder="Current Password" aria-label="Current Password" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white col-4 bg-dark-gradient" id="sender_email">New Password</span>
                                        <input type="password" name="password" class="form-control" value="" placeholder="New Password" aria-label="sender_email" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="mail_mailer">Confirm Password</span>
                                        <input type="password" name="confirm_password" class="form-control" value="" placeholder="Confirm Password" aria-label="mail_mailer" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(auth()->user()->hasPermission('admin pass update'))
                            <button class="btn btn-primary float-end" type="submit">update</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
