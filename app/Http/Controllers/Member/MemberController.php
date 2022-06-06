<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Http\Requests\MemberRequest;

class MemberController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'Anggota',
            'mods' => 'member'
        ];

        return customView('member.index', $data);
    }

    public function getData()
    {
        return DataTables::of(Member::query())->make();
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Anggota',
            'action' => route('admin.members.store')
        ];

        return customView('member.form', $data);
    }

    public function store(MemberRequest $request)
    {
        try {
            $member = Member::create($request->only(['name','phone','email','address']));
            User::create([
                'member_id' => $member->id,
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->email,
                'password' => Hash::make(1234),
            ])->assignRole('Member');

            return response()->json([
                'message' => 'Data telah ditambahkan'
            ]);
        } catch(Exception $e) {
            return restponse()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function edit(Member $member)
    {
        $data = [
            'title' => 'Edit Anggota',
            'action' => route('admin.members.update', $member->hashid), 
            'data' => $member
        ];

        return customView('member.form', $data);
    }

    public function update(MemberRequest $request, Member $member)
    {
        try {
            $member->update($request->only(['name','phone','email','address']));

            return response()->json([
                'message' => 'Data telah diupdate'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }

    public function destroy(Member $member) 
    {
        try {
            $member->delete();
            $member->user->delete();

            return response()->json([
                'message' => 'Data telah dihapus'
            ]);
        } catch(Exception  $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ], 500);
        }
    }
}
