@extends('layouts.app')

@section('title')
    New Post
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media (max-width: 991px) {
            .sidebar {
                display: none;
            }
        }

        @media (min-width: 991px) {
            .mobile-nav {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <body class="index-page sidebar-collapse bg-gradient-orange">
    <div class="container-fluid" style="margin-top:15px;">
        <div class="card" style="min-height: calc(100vh - 30px);">
            <div class="card-header" style="padding-left:25px;" align="right">
                <div style="position:absolute;left:25px;top:25px;">Admin Panel</div>
                @include('app.admin-menu')
            </div>
            <div class="row">
                @include('app.admin-sidebar')
                <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
                    <div class="main col-md-12" style="background:none;margin-top:25px;">
                        <div class="col-md-6">
                            <h5>{{ $module->name }} Module Settings</h5>
                            <form action="/app/modules/auth0/settings" method="post" style="margin-top:25px;">
                                {{ csrf_field() }}
                                <div class="card">
                                    <div class="card-body">
                                        <?php $settings = $json->settings; ?>
                                        <div class="col-md-12">
                                            <?php foreach($settings as $setting) { ?>
                                            @if($setting->type == "checkbox")
                                                <div class="form-group">
                                                    <label>
                                                        {{$setting->description}}
                                                    </label>
                                                    <br>
                                                    <input type="checkbox"
                                                           @if($module->hasMeta($setting->name) && $module->hasMeta($setting->name) == "on") checked
                                                           @endif name="{{$setting->name}}" id="{{$setting->name}}"
                                                           class="bootstrap-switch" data-on-label="On"
                                                           data-off-label="Off"/>
                                                </div>
                                            @endif
                                            @if($setting->type == "text")
                                                <div class="form-group">
                                                    <label for="settingValue">{{$setting->description}}</label>
                                                    <input type="text" class="form-control" id="{{$setting->name}}"
                                                           aria-describedby="settingValue" placeholder="Value goes here"
                                                           name="{{$setting->name}}"
                                                           @if($module->hasMeta($setting->name)) value="{{ $module->getMeta($setting->name)->value }}" @endif >
                                                </div>
                                            @endif
                                            @if($setting->type == "select")
                                                <div class="form-group">
                                                    <label for="settingValue">{{$setting->description}}</label>
                                                    <select class="custom-select" id="status" name="status"
                                                            aria-describedby="settingStatus" style="width:100%;">
                                                        @foreach($setting->options as $option)
                                                            <option value="{{$option}}">{{$option}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div align="right">
                                            <button type="submit" class="btn btn-secondary-outline ">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    </body>
@endsection