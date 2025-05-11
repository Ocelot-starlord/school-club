<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายงานตามห้องเรียน</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 40px;
            background: #f4f4f4;
        }

        h2 {
            margin-top: 40px;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>
<body>

    <h1>รายงานการลงทะเบียนชุมนุมตามห้องเรียน</h1>

    @forelse($registrations as $classroom => $group)
        <h2>ห้อง {{ $classroom }}</h2>
        <table>
            <thead>
                <tr>
                    <th>รหัสนักเรียน</th>
                    <th>ชื่อ</th>
                    <th>ชุมนุม</th>
                    <th>ครูผู้ดูแล</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $reg)
                    <tr>
                        <td>{{ $reg->student->id }}</td>
                        <td>{{ $reg->student->name }}</td>
                        <td>{{ $reg->club->name }}</td>
                        <td>{{ $reg->club->teacher_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @empty
        <p>ยังไม่มีข้อมูลการลงทะเบียน</p>
    @endforelse

</body>
</html>
