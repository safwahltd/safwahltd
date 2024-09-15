@extends('admin.layout.app')
@section('title','Email Setting')
@section('body')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="border-bottom m-3">
                    <div class="row">
                        <div class="card-header border-bottom justify-content-between">
                            <h3 class="card-title">Email Settings</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{route('admin.email.setting.update',$emailSetting->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center mb-4">
                            <div class="col-md-8 mx-0">
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="company_name">Sender Name</span>
                                        <input type="text" name="sender_name" class="form-control" value="{{$emailSetting->sender_name}}" placeholder="sender name" aria-label="sender name" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white col-4 bg-dark-gradient" id="sender_email">Sender Email</span>
                                        <input type="text" name="sender_email" class="form-control" value="{{$emailSetting->sender_email}}" placeholder="sender email" aria-label="sender_email" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="mail_mailer">Mail Mailer</span>
                                        <input type="text" name="mail_mailer" class="form-control" value="{{$emailSetting->mail_mailer}}" placeholder="mail mailer" aria-label="mail_mailer" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="mail_host">Mail Host</span>
                                        <input type="text" name="mail_host" class="form-control" value="{{$emailSetting->mail_host}}" placeholder="mail host" aria-label="mail_host" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="email">Mail Port</span>
                                        <input type="number" name="mail_port" class="form-control" value="{{$emailSetting->mail_port}}" placeholder="mail port" aria-label="mail port" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text  text-white col-4 bg-dark-gradient" id="address">Mail Encryption</span>
                                        <select class="form-control" aria-label="mail_encryption" aria-describedby="basic-addon1" name="mail_encryption" id="mail_encryption">
                                            <option {{$emailSetting->mail_encryption == 'tls' ? 'selected':''}} value="tls">tls</option>
                                            <option {{$emailSetting->mail_encryption == 'ssl' ? 'selected':''}} value="ssl">ssl</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white col-4 bg-dark-gradient" id="mail_username">Mail Username</span>
                                        <input type="text" name="mail_username" class="form-control" value="{{$emailSetting->mail_username}}" placeholder="mail username" aria-label="mail username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="row input-group mb-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text text-white  col-4 bg-dark-gradient" id="mail_password">Mail Password</span>
                                        <input type="text" name="mail_password" class="form-control" value="{{$emailSetting->mail_password}}" placeholder="mail password" aria-label="mail password" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary float-end" type="submit">update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

