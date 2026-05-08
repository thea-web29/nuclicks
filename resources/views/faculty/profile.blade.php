<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile – NuClicks</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; min-height: 100vh; display: flex; align-items: flex-start; justify-content: center; padding: 40px 20px; }
        .card { background: #fff; border-radius: 12px; padding: 36px; width: 100%; max-width: 600px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        h1 { font-size: 22px; font-weight: 700; color: #1a1a2e; margin-bottom: 28px; }
        .avatar-section { display: flex; align-items: center; gap: 20px; margin-bottom: 30px; }
        .avatar-img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #1a1a2e; }
        .avatar-placeholder { width: 80px; height: 80px; border-radius: 50%; background: #1a1a2e; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 700; }
        .avatar-upload label { display: inline-block; padding: 7px 16px; background: #f0f2f5; border: 1px solid #ddd; border-radius: 6px; font-size: 13px; cursor: pointer; font-weight: 600; color: #444; }
        .avatar-upload label:hover { background: #e4e6eb; }
        .avatar-upload input { display: none; }
        .alert { padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 18px; }
        .alert-success { background: #e6f9f0; color: #1a7a4a; border-left: 3px solid #27ae60; }
        .alert-error   { background: #fdecea; color: #c0392b; border-left: 3px solid #e63946; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; font-weight: 600; color: #444; margin-bottom: 6px; }
        input[type="text"], input[type="email"], textarea {
            width: 100%; padding: 10px 14px; border: 1px solid #ddd; border-radius: 7px;
            font-size: 14px; outline: none; transition: border-color .2s; color: #333;
        }
        input:focus, textarea:focus { border-color: #1a1a2e; box-shadow: 0 0 0 3px rgba(26,26,46,.10); }
        textarea { resize: vertical; min-height: 90px; }
        .btn-save { width: 100%; padding: 11px; background: #1a1a2e; color: #fff; border: none; border-radius: 7px; font-size: 14px; font-weight: 700; cursor: pointer; margin-top: 8px; }
        .btn-save:hover { background: #2c2c54; }
        .back-link { display: inline-block; margin-bottom: 20px; font-size: 13px; color: #1a1a2e; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="card">
    <a href="{{ route('faculty.dashboard') }}" class="back-link">← Back to Dashboard</a>
    <h1>My Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    {{-- Avatar upload --}}
    <div class="avatar-section">
        @if($user->avatar)
            <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="avatar-img">
        @else
            <div class="avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
        @endif
        <div class="avatar-upload">
            <form method="POST" action="{{ route('faculty.avatar.update') }}" enctype="multipart/form-data" id="avatar-form">
                @csrf
                <label for="avatar-input">Change Photo</label>
                <input type="file" id="avatar-input" name="avatar" accept="image/*"
                       onchange="document.getElementById('avatar-form').submit()">
            </form>
        </div>
    </div>

    {{-- Profile details --}}
    <form method="POST" action="{{ route('faculty.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form-group">
            <label>Specialization</label>
            <input type="text" name="specialization" value="{{ old('specialization', $user->specialization ?? '') }}" placeholder="e.g. Computer Science">
        </div>
        <div class="form-group">
            <label>Qualification</label>
            <input type="text" name="qualification" value="{{ old('qualification', $user->qualification ?? '') }}" placeholder="e.g. PhD, MS">
        </div>
        <div class="form-group">
            <label>Bio</label>
            <textarea name="bio" placeholder="Short bio...">{{ old('bio', $user->bio ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn-save">Save Changes</button>
    </form>
</div>
</body>
</html>