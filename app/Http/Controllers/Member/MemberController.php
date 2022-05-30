<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use DataTables;

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

}
