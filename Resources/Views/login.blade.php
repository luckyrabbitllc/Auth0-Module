@extends('layouts.app')

@section('title')
    Login
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
<style>
    #root {
        border:none !important;
    }
    .auth0-lock-header{
        display:none !important;
    }
    .auth0-lock-name {
        display:none;
    }
    .auth0-lock-header-bg {
        height:80px !important;
        background:#fff !important;
    }
    .auth0-lock-widget{
        box-shadow: 0px 10px 30px rgba(0,0,0,0.15);
        border-radius:0px 0px 4px 4px !important;
    }
    .auth0-lock-tabs {
        border-radius: 4px 4px 0px 0px;
    }
    .auth0-lock-submit {
        background: linear-gradient(45deg, #5162ff, #2e99ff) !important;
        font-weight:500 !important;
    }
    .auth0-lock-widget input {
        box-shadow:none !important;
    }
    .auth0-lock.auth0-lock .auth0-lock-tabs-container {
        margin: -20px -20px 20px !important;
        height: 55px !important;
    }
</style>
@endsection


@section('content')
    <body class="index-page sidebar-collapse bg-gradient-orange" style="height:100vh;">
        <div class="container" style="margin-top:15px;">
            <div class="col-md-12" align="center">
                <div class="row">
                <div id="root"
                     style="width: 320px; margin: 40px auto; padding: 10px; border-style: dashed; border-width: 1px; box-sizing: border-box;">
                    embedded area
                </div>
                <script src="https://cdn.auth0.com/js/lock/10.20/lock.min.js"></script>
                <script>
                    var lock = new Auth0Lock('{{ $module->getMeta('auth0-client-id')->value }}', '{{ $module->getMeta('auth0-domain')->value }}', {
                        container: 'root',
                        auth: {
                            redirectUrl: '{{ $module->getMeta('auth0-redirect-url')->value }}',
                            responseType: 'code',
                            params: {
                                scope: 'openid email' // Learn about scopes: https://auth0.com/docs/scopes
                            }
                        }
                    });
                    lock.show();
                </script>
                </div>
            </div>
        </div>
    </body>
@endsection
