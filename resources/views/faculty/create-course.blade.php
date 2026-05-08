<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course – NuClicks</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; min-height: 100vh; display: flex; align-items: flex-start; justify-content: center; padding: 40px 20px; }
        .card { background: #fff; border-radius: 12px; padding: 36px; width: 100%; max-width: 560px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        h1 { font-size: 20px; font-weight: 700; color: #1a1a2e; margin-bottom: 28px; }
        .alert-error { padding: 10px 14px; border-radius: 6px; font-size: 13px; margin-bottom: 18px; background: #fdecea; color: #c0392b; border-left: 3px solid #e63946; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; font-weight: 600; color: #444; margin-bottom: 6px; }
        input[type="text"], select, textarea {
            width: 100%; padding: 10px 14px; border: 1px solid #ddd; border-radius: 7px;
            font-size: 14px; outline: none; transition: border-color .2s; color: #333;
        }
        input:focus, select:focus, textarea:focus { border-color: #1a1a2e; box-shadow: 0 0 0 3px rgba(26,26,46,.10); }
        textarea { resize: vertical; min-height: 90px; }
        .btn-row { display: flex; gap: 12px; margin-top: 28px; }
        .btn-save { flex: 1; padding: 11px; background: #1a1a2e; color: #fff; border: none; border-radius: 7px; font-size: 14px; font-weight: 700; cursor: pointer; }
        .btn-save:hover { background: #2c2c54; }
        .btn-cancel { flex: 1; padding: 11px; background: #f0f2f5; color: #555; border: 1px solid #ddd; border-radius: 7px; font-size: 14px; font-weight: 600; cursor: pointer; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center; }
        .btn-cancel:hover { background: #e4e6eb; }
        .back-link { display: inline-block; margin-bottom: 20px; font-size: 13px; color: #1a1a2e; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="card">
    <a href="{{ route('faculty.courses') }}" class="back-link">← Back to Courses</a>
    <h1>Create New Course</h1>

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('faculty.store.course') }}">
        @csrf

        <div class="form-group">
            <label>Subject Code <span style="color:#e63946">*</span></label>
            <input type="text" name="subject_code" value="{{ old('subject_code') }}" placeholder="e.g. CS101" required>
        </div>

        <div class="form-group">
            <label>Subject Name <span style="color:#e63946">*</span></label>
            <input type="text" name="subject_name" value="{{ old('subject_name') }}" placeholder="e.g. Introduction to Computing" required>
        </div>

        <div class="form-group">
            <label>Section <span style="color:#e63946">*</span></label>
            <input type="text" name="section" value="{{ old('section') }}" placeholder="e.g. A, B, 1A" required>
        </div>

        <div class="form-group">
            <label>Program</label>
            <select name="program_id">
                <option value="">— Select Program —</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                        {{ $program->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" placeholder="Short description of this course...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Schedule</label>
            <input type="text" name="schedule" value="{{ old('schedule') }}" placeholder="e.g. MWF 9:00–10:00 AM">
        </div>

        <div class="form-group">
            <label>Room</label>
            <input type="text" name="room" value="{{ old('room') }}" placeholder="e.g. Room 301">
        </div>

        <div class="btn-row">
            <a href="{{ route('faculty.courses') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-save">Create Course</button>
        </div>
    </form>
</div>
</body>
</html>