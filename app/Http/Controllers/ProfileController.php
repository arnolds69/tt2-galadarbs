<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
   public function show($id) {
    $user = User::findOrFail($id);
    $postCount = \App\Models\Post::where('user_id', $id)->count();
    $isFollowing = auth()->check() 
        ? \DB::table('seko')->where('sekotajs', auth()->id())->where('seko', $id)->exists()
        : false;
    $followerCount = \DB::table('seko')->where('seko', $id)->count();
    $followers = \DB::table('seko')->where('seko', $id)->join('users', 'seko.sekotajs', '=', 'users.id')->select('users.id', 'users.username')->get();
    return view('profile', compact('user', 'postCount', 'isFollowing', 'followerCount', 'followers'));
    }


public function follow($id) {
    \DB::table('seko')->insertOrIgnore([
        'sekotajs' => auth()->id(),
        'seko' => $id,
    ]);
    return back();
}

public function unfollow($id) {
    \DB::table('seko')->where('sekotajs', auth()->id())->where('seko', $id)->delete();
    return back();
}

public function updatePassword(Request $request, $id) {
    $user = User::findOrFail($id);
    $user->update(['password' => Hash::make($request->password)]);
    return back()->with('success', 'Password updated.');
    }
public function followers($id) {
    $user = User::findOrFail($id);
    $followers = \DB::table('seko')
        ->where('seko', $id)
        ->join('users', 'seko.sekotajs', '=', 'users.id')
        ->select('users.id', 'users.username')
        ->paginate(50);
    return view('followers', compact('user', 'followers'));
}
    
}