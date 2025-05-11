<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            รายชื่อนักเรียนที่ลงทะเบียนชุมนุม
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg p-6">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-300">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-4 py-2">รหัสนักเรียน</th>
                        <th class="px-4 py-2">ชื่อ</th>
                        <th class="px-4 py-2">ห้อง</th>
                        <th class="px-4 py-2">ชุมนุม</th>
                        <th class="px-4 py-2">ครูที่ปรึกษา</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $r)
                        <tr class="border-b dark:border-gray-600">
                            <td class="px-4 py-2">{{ $r->student->id }}</td>
                            <td class="px-4 py-2">{{ $r->student->name }}</td>
                            <td class="px-4 py-2">{{ $r->student->classroom }}</td>
                            <td class="px-4 py-2">{{ $r->club->name }}</td>
                            <td class="px-4 py-2">{{ $r->club->teacher_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
