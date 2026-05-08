<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course – NuClicks</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; min-height: 100vh; display: flex; align-items: flex-start; justify-content: center; padding: 40px 20px; }
        .card { background: #fff; border-radius: 12px; padding: 36px; width: 100%; max-width: 560px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        h1 { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 6px; }
        .sub { font-size: 13px; color: #888; margin-bottom: 28px; }
        .alert { padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 18px; }
        .alert-success { background: #e6f9f0; color: #1a7a4a; border-left: 3px solid #27ae60; }
        .alert-error   { background: #fdecea; color: #c0392b; border-left: 3px solid #e63946; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 13px; font-weight: 600; color: #444; margin-bottom: 6px; }
        input[type="text"], textarea {
            width: 100%; padding: 10px 14px; border: 1px solid #ddd; border-radius: 7px;
            font-size: 14px; outline: none; transition: border-color .2s, box-shadow .2s; color: #333;
        }
        input[type="text"]:focus, textarea:focus {
            border-color: #1a1a2e; box-shadow: 0 0 0 3px rgba(26,26,46,0.10);
        }
        textarea { resize: vertical; min-height: 100px; }
        .readonly-field {
            width: 100%; padding: 10px 14px; border: 1px solid #eee; border-radius: 7px;
            font-size: 14px; background: #f8f8f8; color: #888;
        }
        .btn-row { display: flex; gap: 12px; margin-top: 28px; }
        .btn-save {
            flex: 1; padding: 11px; background: #1a1a2e; color: #fff; border: none;
            border-radius: 7px; font-size: 14px; font-weight: 700; cursor: pointer; transition: background .2s;
        }
        .btn-save:hover { background: #2c2c54; }
        .btn-cancel {
            flex: 1; padding: 11px; background: #f0f2f5; color: #555; border: 1px solid #ddd;
            border-radius: 7px; font-size: 14px; font-weight: 600; cursor: pointer; text-align: center;
            text-decoration: none; display: flex; align-items: center; justify-content: center;
        }
        .btn-cancel:hover { background: #e8eaf0; }
    </style>
</head>
<body>
<div class="card">
    <h1>Edit Course</h1>
    <p class="sub">{{ $course->subject_code ?? $course->code ?? '' }} — {{ $course->subject_name ?? $course->name ?? '' }}</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('faculty.update.course', $course->id) }}">
        @csrf
        @method('PUT')

        {{-- Read-only info --}}
        <div class="form-group">
            <label>Subject Code</label>
            <div class="readonly-field">{{ $course->subject_code ?? $course->code ?? '—' }}</div>
        </div>

        <div class="form-group">
            <label>Subject Name</label>
            <div class="readonly-field">{{ $course->subject_name ?? $course->name ?? '—' }}</div>
        </div>

        <div class="form-group">
            <label>Section</label>
            <div class="readonly-field">{{ $course->section ?? '—' }}</div>
        </div>

        {{-- Editable fields --}}
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Short description of this course...">{{ old('description', $course->description ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label for="schedule">Schedule</label>
            <input type="text" id="schedule" name="schedule"
                   value="{{ old('schedule', $course->schedule ?? '') }}"
                   placeholder="e.g. MWF 9:00–10:00 AM">
        </div>

        <div class="form-group">
            <label for="room">Room</label>
            <input type="text" id="room" name="room"
                   value="{{ old('room', $course->room ?? '') }}"
                   placeholder="e.g. Room 301">
        </div>

        <div class="btn-row">
            <a href="{{ route('faculty.course.details', $course->id) }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-save">Save Changes</button>
        </div>
    </form>
</div>
</body>
</html>