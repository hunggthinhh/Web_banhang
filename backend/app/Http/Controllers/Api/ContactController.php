<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource for admin.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        return response()->json($contacts);
    }

    /**
     * Store a newly created contact message.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/|max:255',
            'phone' => 'nullable|regex:/^0\d{9}$/',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ], [
            'email.regex' => 'Email phải có định dạng @gmail.com',
            'phone.regex' => 'Số điện thoại phải bao gồm đúng 10 chữ số và bắt đầu bằng số 0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $contact = Contact::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật thành công! Chúng tôi sẽ phản hồi sớm nhất.',
            'data' => $contact
        ], 201);
    }

    /**
     * Display the specified contact.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    /**
     * Update status (mark as read).
     */
    public function updateStatus(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->is_read = true;
        $contact->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Đã đánh dấu là đã đọc.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Đã xoá tin nhắn.'
        ]);
    }
}
