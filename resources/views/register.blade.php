<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ลงทะเบียนชุมนุม</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
            background-image: url('{{ asset('patiu-bg.png') }}');
            background-size: cover;          
            background-repeat: no-repeat;  
            background-position: center;    
            background-attachment: fixed;   
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 16px;
            background-color: #6b7280; /* Tailwind bg-gray-500 */
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .back-button:hover {
            background-color: #374151; /* Tailwind bg-gray-700 */
        }

        .success { color: green; margin-bottom: 10px; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="{{ route('dashboard') }}" class="back-button">← กลับหน้าหลัก</a>

        <h1>แบบฟอร์มลงทะเบียนชุมนุม</h1>

        {{-- แสดงข้อความสำเร็จ --}}
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        {{-- แสดงข้อความผิดพลาด --}}
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        {{-- แสดง Error validation --}}
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ฟอร์มลงทะเบียน --}}
        <form action="{{ route('register-club.submit') }}" method="POST">
            @csrf

            <label>รหัสนักเรียน:</label>
            <input type="text" name="student_id" value="{{ Auth::user()->student_id }}" readonly>

            <label>ชื่อ:</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" readonly>

            <label>ห้องเรียน:</label>
            <input type="text" name="classroom" placeholder="เช่น ม.2/1" value="{{ old('classroom', Auth::user()->classroom) }}">

            <label>เลือกชุมนุม:</label>
            <select name="club_id">
                @foreach($clubs as $club)
                    <option value="{{ $club->id }}">
                        {{ $club->name }} ({{ $club->teacher_name }}) 
                        - เหลือ {{ $club->capacity - $club->registrations->count() }} ที่นั่ง
                    </option>
                @endforeach
            </select>

            <button type="submit">ลงทะเบียน</button>
        </form>
    </div>
</body>
</html>
