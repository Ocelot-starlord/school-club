<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\Student;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;


class ClubRegistrationController extends Controller
{
    // แสดงหน้าแบบฟอร์ม
    public function showForm()
    {
        // ดึงชุมนุมทั้งหมดพร้อมข้อมูลที่ลงทะเบียนไว้แล้ว
        $clubs = Club::with('registrations')->get();

        return view('register', compact('clubs'));
    }
    

    public function showRegisteredList(Request $request)
    {
        $clubs = \App\Models\Club::all();

        $club_id = $request->get('club_id');

        $registrations = \App\Models\Registration::with(['student', 'club'])
            ->when($club_id, fn($query) => $query->where('club_id', $club_id))
            ->get()
            ->sortBy('student.classroom');

        return view('registered_list', compact('registrations', 'clubs', 'club_id'));
    }
    public function reportByClassroom()
    {
        $registrations = \App\Models\Registration::with(['student', 'club'])
            ->get()
            ->groupBy(function ($item) {
                return $item->student->classroom;
            });

        return view('report_by_classroom', compact('registrations'));
    }

    // ประมวลผลเมื่อส่งฟอร์ม
    public function submitForm(Request $request)
    {
        $request->validate([
            'classroom' => ['required', 'regex:/^ม\.\d+\/\d+$/'],
        ], [
            'classroom.regex' => 'กรุณากรอกห้องในรูปแบบ "ม.2/1"',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            // ✅ อัปเดตห้องเรียนของ user ที่ login
            $user->classroom = $request->classroom;
            $user->save();

            $club = Club::with('registrations')->where('id', $request->club_id)->lockForUpdate()->first();
            if ($club->allowed_classrooms) {
                $allowed = json_decode($club->allowed_classrooms, true);
            
                if (!is_array($allowed) || !in_array($request->classroom, $allowed)) {
                    DB::rollBack();
                    return back()->with('error', 'ชุมนุมนี้สงวนสิทธิ์เฉพาะห้อง: ' . implode(', ', (array)$allowed));
                }
            }
            


            $student = Student::updateOrCreate(
                ['id' => $user->student_id],
                ['name' => $user->name, 'classroom' => $request->classroom]
            );

            if (Registration::where('student_id', $student->id)->exists()) {
                DB::rollBack();
                return back()->with('error', 'คุณได้ลงทะเบียนแล้ว');
            }

            Registration::create([
                'student_id' => $student->id,
                'club_id' => $club->id
            ]);

            DB::commit();
            return redirect()->route('register.success');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
        }
    }
    public function create()
    {
        return view('register-club');
    }
    
}
