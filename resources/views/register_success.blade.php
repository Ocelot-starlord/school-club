<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ลงทะเบียนสำเร็จ</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f0f9ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h1>✅ ลงทะเบียนสำเร็จ!</h1>
        <p>ขอบคุณที่ลงทะเบียนชุมนุม</p>
        <a href="{{ route('dashboard') }}">กลับหน้าแรก</a>
    </div>
</body>
</html>
