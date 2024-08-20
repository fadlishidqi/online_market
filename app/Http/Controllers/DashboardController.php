<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\SubscribeTransaction;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $coursesCount = Course::count();
        $studentsCount = CourseStudent::distinct('user_id')->count('user_id');
        $categoriesCount = Category::count();
        $teachersCount = Teacher::count();

        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Mendapatkan kursus yang sudah dibayar oleh user jika dia memiliki peran 'student'
        $paidCourses = collect();

        if ($user->hasRole('student')) {
            $paidCourses = $user->courses()->wherePivot('is_paid', true)->get();
        }

        return view('dashboard', compact('categoriesCount', 'coursesCount', 'studentsCount', 'teachersCount', 'paidCourses'));
    }

}
