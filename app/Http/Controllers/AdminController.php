<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function auditLog()
    {
        return view('admin.audit-log');
    }

    public function users()
    {
        return view('admin.users'); // Assume view exists or create
    }

    public function editUser($id)
    {
        return view('admin.edit-user', compact('id'));
    }

    public function updateUser(Request $request, $id)
    {
        // TODO: Implement update
        return redirect()->back()->with('success', 'User updated');
    }
}
}
