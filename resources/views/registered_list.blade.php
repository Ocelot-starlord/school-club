<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายชื่อนักเรียนที่ลงทะเบียน</title>
</head>
<body>
    <h1>รายชื่อนักเรียนที่ลงทะเบียนชุมนุม</h1>
    <form method="GET" action="{{ route('report-all') }}">
        <label for="club_id">เลือกชุมนุม:</label>
        <select name="club_id" id="club_id" onchange="this.form.submit()">
            <option value="">-- ดูทั้งหมด --</option>
            @foreach ($clubs as $club)
                <option value="{{ $club->id }}" {{ $club_id == $club->id ? 'selected' : '' }}>
                    {{ $club->name }} ({{ $club->teacher_name }})
                </option>
            @endforeach
        </select>
    </form>
    <br>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>รหัสนักเรียน</th>
                <th>ชื่อ</th>
                <th>ห้อง</th>
                <th>ชุมนุม</th>
                <th>ครูผู้ดูแล</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $reg)
                <tr>
                    <td>{{ $reg->student->user->student_id ?? '-' }}</td>
                    <td>{{ $reg->student->name }}</td>
                    <td>{{ $reg->student->classroom }}</td>
                    <td>{{ $reg->club->name }}</td>
                    <td>{{ $reg->club->teacher_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
