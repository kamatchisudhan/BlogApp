<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Fetch users from the API
            $response = Http::get('https://jsonplaceholder.typicode.com/users');

            // Check if the response is successful
            if ($response->successful()) {
                $users = $response->json();
            } else {
                return back()->with('error', 'Failed to fetch users from the API.');
            }

            // Search functionality
            $search = $request->input('search');
            if ($search) {
                $users = array_filter($users, function ($user) use ($search) {
                    return stripos($user['name'], $search) !== false;
                });
            }

            return view('users.index', compact('users', 'search'));
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
