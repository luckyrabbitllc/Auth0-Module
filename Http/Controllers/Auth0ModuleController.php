<?php

namespace App\Modules\auth0\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Auth0ModuleController extends Controller
{
    public function index($module) {
        $modulepath = app_path()."/Modules/".$module."/module.json";
        $json = json_decode(File::get($modulepath));
        $module = \App\Module::where('slug', '=', $module)->firstOrFail();
        return view("auth0::settings")->with('json', $json)->with('module', $module);
    }

    public function saveSettings(Request $request, $module) {
        $module = \App\Module::where('slug', '=', $module)->firstOrFail();
        $module->deleteAllMeta();
        foreach($request->input() as $key => $value) {
            if ($key !== null && $value !== null && $key !== '_token') {
                $module->addMeta($key, $value);
            }
        }
        $module->save();
        return redirect('/app/modules/auth0/settings');
    }

    public function login(){
        $module = \App\Module::where('slug', '=', 'auth0')->firstOrFail();
        if($module->hasMeta('enabled') && $module->getMeta('enabled')->value == 'on') {
            //return \App::make('auth0');
            return view("auth0::login")->with('module', $module);
        }
        else {
            abort(404);
        }
    }
}