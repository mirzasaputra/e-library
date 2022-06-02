<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use Vinkla\Hashids\Facades\Hashids;

class RoleController extends Controller
{
    
    public function index()
    {
        $data = [ 
            'title' => 'Roles',
            'mods'=> 'role'
        ];

        return customView('role.index', $data);
    }

    public function getData()
    {
        return DataTables::of(Role::whereNotIn('name', ['Developer']))->addColumn('hashid', function($data){
            return Hashids::encode($data->id);
        })->make();
    }

    public function store(RoleRequest $request)
    { 
        try {
            Role::create($request->only(['name']));

            return response()->json([
                'message' => 'Data telah ditambahkan'
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ], 500);
        }
    }

    public function show($id)
    {
        $remappedPermission = [];
        $permissions = Permission::all()->pluck('name');
        $role = Role::find(Hashids::decode($id)[0]);


        foreach ($permissions as $permission) {
            $explodePermissions = \explode('-', $permission);
            $slicePermissions = array_slice($explodePermissions, 1);
            $implodePermissions = \implode('-', $slicePermissions);
            $remappedPermission[$implodePermissions][] = $permission;
        }

        $data = [
            'title' => 'Ubah Permission',
            'mods' => 'role',
            'role' => $role,
            'permissions' => $remappedPermission,
            'id' => Hashids::encode($role->id)
        ];

        return customView('role.change-permission', $data);
    }

    public function changePermission(Request $request, $id)
    {
        try {
            $role = Role::find(Hashids::decode($id)[0]);
            $role->syncPermissions($request->permission);
            return response()->json([
                'message' => 'Permission berhasil di perbarui',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        return Role::find(Hashids::decode($id)[0]);
    }

    public function update(RoleRequest $request, $id)
    {
        try {
            Role::findOrFail($id)->update($request->only('name'));

            return response()->json([
                'message' => 'Data telah diubah'
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Role::findOrFail(Hashids::decode($id)[0])->delete();

            return response()->json([
                'message' => 'Data telah dihapus',
            ]);
        } catch(Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ], 500);
        }
    }

}
