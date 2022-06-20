<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use DataTables;

class SettingController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Pengaturan',
            'mods' => 'setting'
        ];

        return customView('setting.index', $data);
    }

    public function getData()
    {
        return DataTables::of(Setting::query())->editColumn('group', function($data){
            return ucfirst($data->group);
        })->editColumn('value', function($data){
            if($data->group == 'config' && $data->key == 'app_money_fine'){
                return 'Rp. ' . number_format($data->value, 0, ',', '.');
            } else {
                return $data->value;
            }
        })->make();
    }

    public function update(Request $request, Setting $setting)
    {
        try {
            $setting->update([
                'value' => $request->name == 'Denda Aplikasi Perhari' ? stripCharacter($request->value) : $request->value,
            ]);

            return response()->json([
                'message' => 'Data telah ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
