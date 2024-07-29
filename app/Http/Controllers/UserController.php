<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class UserController extends Controller
{
    public function fetch(Request $request)
    {
        $page = $request->query('page');

        if (!$page) {
            return response()->json(['error' => 'Missing query parameter: page'], 400);
        }

        $response = Http::get('https://reqres.in/api/users', ['page' => $page]);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }

        $users = $response->json('data');

        $fetchedData = [];
        foreach ($users as $user) {
            $existingUser = User::find($user['id']);
            if (!$existingUser) {
                $newUser = User::create([
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'avatar' => $user['avatar'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $fetchedData[] = $newUser;
            }
        }

        return response()->json($fetchedData);
    }

    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->update($request->all());

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
