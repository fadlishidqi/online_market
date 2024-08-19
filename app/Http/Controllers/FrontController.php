<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(){

        $courses = Course::with(['category', 'teacher', 'students'])->orderByDesc('id')->get();
        return view('front.index', compact('courses'));
    }

    public function category(Category $category){
        // Ambil data kursus berdasarkan kategori
        $courses = Course::where('category_id', $category->id)->get();
    
        return view('front.category', compact('courses', 'category'));
    }

    public function details(Course $course)
    {
        $user = Auth::user();

        // Periksa apakah user sudah membayar kursus ini
        $hasPaid = $user->courses()
                        ->where('course_id', $course->id)
                        ->wherePivot('is_paid', true)
                        ->exists();

        return view('front.details', compact('course', 'hasPaid'));
    }


    public function pricing(){
        return view('front.pricing');
    }

    public function learning(Course $course, $courseVideoId)
    {
        $user = Auth::user();

        $hasAccess = $user->courses()->where('course_id', $course->id)->wherePivot('is_paid', true)->exists();

        if (!$hasAccess) {
            return redirect()->route('front.checkout', $course->id)->with('error', 'Anda harus membayar kursus ini untuk mengakses materi.');
        }

        $video = $course->course_videos()->findOrFail($courseVideoId);

        return view('front.learning', compact('course', 'video'));
    }


    public function checkout($courseId)
    {
        $course = Course::findOrFail($courseId);
         
        return view('front.checkout', compact('course'));
    }
}
