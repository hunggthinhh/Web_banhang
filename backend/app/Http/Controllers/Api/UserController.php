<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Get all users with their orders count
        $users = User::withCount('orders')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json($users);
    }

    /**
     * Update the user's role.
     */
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,user'
        ]);

        $user = User::findOrFail($id);
        
        // Prevent changing own role if logged in admin (security measure)
        if ($request->user()->id == $id) {
            return response()->json(['message' => 'Bạn không thể tự thay đổi quyền của chính mình!'], 403);
        }

        $user->role = $request->role;
        $user->save();

        return response()->json([
            'message' => 'Cập nhật phân quyền thành công!',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Prevent deleting self
        if ($request->user()->id == $id) {
            return response()->json(['message' => 'Bạn không thể tự xóa tài khoản của chính mình!'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'Xóa người dùng thành công!']);
    }

    public function getCart(Request $request)
    {
        return response()->json([
            'cart' => $request->user()->cart ? json_decode($request->user()->cart) : []
        ]);
    }

    public function updateCart(Request $request)
    {
        $user = $request->user();
        $user->cart = is_string($request->cart) ? $request->cart : json_encode($request->cart);
        $user->save();

        return response()->json(['message' => 'Lưu giỏ hàng thành công!']);
    }
}
