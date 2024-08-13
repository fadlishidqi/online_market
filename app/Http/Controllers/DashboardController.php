<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\SubscribeTransaction;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah total kursus
        $courses = Course::count();

        // Menghitung jumlah siswa unik untuk semua kursus
        $students = CourseStudent::distinct('user_id')->count('user_id');

        // Menghitung jumlah kategori, transaksi, dan guru
        $categories = Category::count();
        $transactions = SubscribeTransaction::count();
        $teachers = Teacher::count();

        return view('dashboard', compact('categories', 'courses', 'transactions', 'students', 'teachers'));
    }
}
