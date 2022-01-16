<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use App\Helpers\GF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CAdministrator extends Controller
{
    public function index()
    {
        return view('admin.administrator')
            ->with('title', 'User Management');
    }
    public function saveCreate(Request $request)
    {
        $user = new User;
        $this->credential($user, $request);
        $user->save();
        return response()->json(['status' => true, 'msg' => 'Sukses menambahkan data pengguna']);
    }
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json(['status' => true, 'data' => $user]);
    }
    public function saveUpdate($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        $this->credential($user, $request);
        $user->update();
        return response()->json(['status' => true, 'msg' => 'Sukses mengubah data pengguna']);
    }
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect(url('user-management'))->with('msg', 'Sukses menghapus pengguna');
    }
    public function credential($user, $request)
    {
        $user->name = $request->nama;
        $user->email = $request->email;
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
    }
    public function datatable(Request $request)
    {
        $model = User::where('email', '!=', Auth::user()->email);
        return DataTables::of($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a id="' . $row->id . '" data-type="edit" href="#" class="btn btn-primary btn-edit btn-sm b-modal"> <i class="material-icons">edit</i></a>';
                $btn .= '<a href="' . url("user-management-delete") . "/" . $row->id . '" class="btn btn-warning btn-delete btn-sm"> <i class="material-icons">delete_outline</i></a>';
                return $btn;
            })
            ->addColumn('role_convert', function ($row) {
                return GF::roleConvert($row->role);
            })
            ->rawColumns(['action', 'role_convert'])
            ->addIndexColumn()
            ->toJson();;
    }
}
