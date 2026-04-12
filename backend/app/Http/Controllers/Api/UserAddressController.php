<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->addresses()->latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'alias' => 'required|string',
            'receiver_name' => 'required|string',
            'receiver_phone' => 'required|string',
            'receiver_email' => 'required|email',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'province_code' => 'required|string',
            'district_code' => 'required|string',
            'ward_code' => 'required|string',
            'detail_address' => 'required|string',
        ]);

        $user = $request->user();

        // If this is the first address, or if is_default is true, handle default logic
        $isDefault = $user->addresses()->count() === 0 || $request->is_default;

        if ($isDefault) {
            $user->addresses()->update(['is_default' => false]);
        }

        $address = $user->addresses()->create([
            'alias' => $request->alias,
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'receiver_email' => $request->receiver_email,
            'province' => $request->province,
            'district' => $request->district,
            'ward' => $request->ward,
            'province_code' => $request->province_code,
            'district_code' => $request->district_code,
            'ward_code' => $request->ward_code,
            'detail_address' => $request->detail_address,
            'is_default' => $isDefault
        ]);

        return response()->json($address, 201);
    }

    public function update(Request $request, $id)
    {
        $address = $request->user()->addresses()->findOrFail($id);

        $request->validate([
            'alias' => 'required|string',
            'receiver_name' => 'required|string',
            'receiver_phone' => 'required|string',
            'receiver_email' => 'required|email',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'province_code' => 'required|string',
            'district_code' => 'required|string',
            'ward_code' => 'required|string',
            'detail_address' => 'required|string',
        ]);

        if ($request->is_default && !$address->is_default) {
            $request->user()->addresses()->update(['is_default' => false]);
            $address->is_default = true;
        }

        $address->update($request->all());

        return response()->json($address);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $address = $request->user()->addresses()->findOrFail($id);
            
            $wasDefault = $address->is_default;
            $address->delete();

            if ($wasDefault) {
                $next = $request->user()->addresses()->first();
                if ($next) {
                    $next->update(['is_default' => true]);
                }
            }

            return response()->json(['message' => 'Xóa địa chỉ thành công']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi xóa: ' . $e->getMessage()], 500);
        }
    }

    public function setDefault(Request $request, $id)
    {
        try {
            $user = $request->user();
            $user->addresses()->update(['is_default' => false]);
            
            $address = $user->addresses()->findOrFail($id);
            $address->update(['is_default' => true]);

            return response()->json(['message' => 'Đã đặt địa chỉ mặc định']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }
}
