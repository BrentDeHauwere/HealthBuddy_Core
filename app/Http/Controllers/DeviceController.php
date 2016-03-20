<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Device;

class DeviceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $devices = Device::with(array('user'=>function($query){
            $query->select('id', 'firstName', 'lastName', 'email');
        }))->get();
        return view('apparaatbeheer')->withDevices($devices);
    }

    public function create()
    {
        return view('adddevice')->with('possibleTypes', Device::getPossbileTypes());
    }

    public function store(Request $request)
    {
        if ($request->has('id') && $request->has('type') && in_array($request->type, Device::getPossbileTypes())) {
            Device::insert([
                'id' => $request->id,
                'type' => $request->type
            ]);
            return view('adddevice')->with('possibleTypes', Device::getPossbileTypes());
        }
        return "Vuile foefelaar!";
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->action('DeviceController@index');
    }
}
