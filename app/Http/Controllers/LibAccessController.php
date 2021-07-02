<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LibAccess;

class LibAccessController extends Controller
{
    public function share_library($id, LibAccess $access)
    {
        $access->user = $id;
        $access->book_author = $this->get_user_id();
        $access->save();
        return redirect('/profile/'.$id);
    }

    public function check_status($user_id, $profile_id)
    {
        $status = LibAccess::where('book_author', '=', $user_id)->where('user', '=', $profile_id)->first();
        
        if($status)
        {
            return 1;
        }

        return 0;
    }

    public function hide_library($id, LibAccess $lib_access)
    {
        $status = $lib_access->where('book_author', '=', $this->get_user_id())->where('user', '=', $id)->first();

        if($status)
        {
            $status->delete();
        }

        return redirect('/profile/'.$id);
    }
}
