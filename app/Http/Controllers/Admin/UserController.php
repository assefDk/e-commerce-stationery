<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request){
        $users = User::latest();
        $users = $users->where('role','user');
        

        if(!empty($request->get('Keyword'))){
            $users = $users->where('name','like','%'.$request->get('Keyword').'%');
            $users = $users->orWhere('email','like','%'.$request->get('Keyword').'%');
        }
        
        $users = $users->paginate(10);

        return view('admin.user.list',[
            'users' => $users
        ]);
    }

    public function destroy($id){
        $user = User::find($id);

        if($user == null){
            $message = 'User not found.';
            session()->flash('error',$message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        }

        $user->delete();
        $message = 'User deleted successfully.';
        session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);

    }




    
    
}
