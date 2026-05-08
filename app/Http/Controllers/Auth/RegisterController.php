<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function create(array $data)
    {
        return User::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'role'       => $data['role'],
            'student_id' => $data['role'] === 'student' ? ($data['student_id'] ?? null) : null,
            'faculty_id' => $data['role'] === 'faculty' ? ($data['faculty_id'] ?? null) : null,
            'department' => $data['department'] ?? null,
            'year_level' => $data['year_level'] ?? null,
        ]);
    }

    protected function validator(array $data)
    {
        return validator($data, [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'confirmed', Password::defaults()],
            'role'       => ['required', 'in:student,faculty'],
            'student_id' => ['nullable', 'required_if:role,student', 'unique:users'],
            'faculty_id' => ['nullable', 'required_if:role,faculty', 'unique:users'],
            'department' => ['nullable', 'string', 'max:255'],
            'year_level' => ['nullable', 'integer', 'min:1', 'max:5'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::login($user);

        return match ($user->role) {
            'faculty' => redirect()->route('faculty.dashboard'),
            default   => redirect()->route('student.dashboard'),
        };
    }
}