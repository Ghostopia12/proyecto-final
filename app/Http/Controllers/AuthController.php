<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            "name"     => "required|string",
            "email"    => "required|email",
            "password" => "required|string",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $user = User::create([
            "name"     => $request->json("name"),
            "email"    => $request->json("email"),
            "password" => bcrypt($request->json("password")),
        ]);

        return $user;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            "email"    => "required|email",
            "password" => "required|string",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $credentials = request(["email", "password"]);
        if ( ! Auth::attempt($credentials)) {
            return response()->json(["error" => "Unauthorized"], Response::HTTP_UNAUTHORIZED);
        }
        $user        = $request->user();
        $tokenResult = $user->createToken("Personal Access Token");

        return response()->json([
            "access_token" => $tokenResult->plainTextToken,
        ]);
    }
}
