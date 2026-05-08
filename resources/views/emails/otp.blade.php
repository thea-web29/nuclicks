<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 30px; margin: 0;">
    <div style="max-width: 500px; margin: auto; background: #ffffff; border-radius: 8px; padding: 36px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">

        <h2 style="color: #e63946; margin-top: 0;">NuClicks</h2>

        <p style="color: #333;">Hello, <strong>{{ $userName }}</strong>!</p>

        <p style="color: #555;">
            Your account requires a password change on first login.<br>
            Use the One-Time Password below to proceed:
        </p>

        <div style="text-align: center; margin: 28px 0;">
            <span style="
                display: inline-block;
                font-size: 36px;
                font-weight: bold;
                letter-spacing: 10px;
                color: #e63946;
                background: #fff5f5;
                border: 2px dashed #e63946;
                border-radius: 8px;
                padding: 16px 32px;
            ">{{ $otp }}</span>
        </div>

        <p style="color: #888; font-size: 13px;">
            ⏱ This OTP is valid for <strong>10 minutes</strong>.<br>
            If you did not request this, please contact your administrator.
        </p>

        <hr style="border: none; border-top: 1px solid #eee; margin: 24px 0;">
        <p style="color: #bbb; font-size: 11px; text-align: center;">
            This is an automated message from NuClicks. Do not reply.
        </p>
    </div>
</body>
</html>