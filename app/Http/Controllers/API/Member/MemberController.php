<?php

namespace App\Http\Controllers\API\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(){
        try {
            $members = Member::all();
            return response()->json($members);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string|unique:members,email',
        ]);

        try {
            Member::create($request->only(['name', 'phone', 'email', 'address']));
            return response()->json([
                'message' => 'Data telah ditambahkan'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function find(Member $member){
        return response()->json($member);
    }

    public function update(Request $request, Member $member){
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
        ]);
        try {
            $member->update($request->only(['name', 'phone', 'email', 'address']));
            return response()->json([
                'message' => 'Data telah diubah'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Member $member){
        try {
            $member->delete();
            return response()->json([
                'message' => 'Data telah dihapus'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'trace' => $e->getTrace(),
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
