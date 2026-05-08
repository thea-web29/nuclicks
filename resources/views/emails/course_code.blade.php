<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 30px;">
    <div style="max-width: 500px; margin: auto; background: white; border-radius: 8px; padding: 30px;">
        <h2 style="color: #e63946;">NuClicks</h2>
        <p>Hello,</p>
        <p>Your teacher <strong>{{ $teacherName }}</strong> has invited you to join:</p>
        <h3 style="color: #333;">{{ $courseName }}</h3>
        <p>Your class code is:</p>
        <div style="font-size: 32px; font-weight: bold; letter-spacing: 6px; color: #e63946; text-align: center; padding: 20px; background: #f9f9f9; border-radius: 6px;">
            {{ $courseCode }}
        </div>
        <p style="margin-top: 20px;">Enter this code in NuClicks to join your class.</p>
        <p style="color: #999; font-size: 12px;">This email was sent from NuClicks.</p>
    </div>
</body>
</html>