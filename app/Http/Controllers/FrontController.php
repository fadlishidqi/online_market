<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index() {
        $user = Auth::user();
        $categories = Category::all();
        $courses = Course::with('students')->get();
    
        $unpaidCourses = collect();
        $paidCourses = collect();
    
        foreach ($courses as $course) {
            $course->hasPaid = $user ? $user->courses()->where('course_id', $course->id)->wherePivot('is_paid', true)->exists() : false;
    
            if ($course->hasPaid) {
                $paidCourses->push($course);
            } else {
                $unpaidCourses->push($course);
            }
        }
    
        // Gabungkan kursus yang belum dibayar terlebih dahulu
        $sortedCourses = $unpaidCourses->merge($paidCourses);
    
        return view('front.index', compact('categories', 'sortedCourses'));
    }    
       

    public function category(Category $category)
    {
        $user = Auth::user();
        $courses = $category->courses()->with('students')->get();

        $unpaidCourses = collect();
        $paidCourses = collect();

        foreach ($courses as $course) {
            $course->hasPaid = $user ? $user->courses()->where('course_id', $course->id)->wherePivot('is_paid', true)->exists() : false;
    
            if ($course->hasPaid) {
                $paidCourses->push($course);
            } else {
                $unpaidCourses->push($course);
            }
        }
    
        // Gabungkan kursus yang belum dibayar terlebih dahulu
        $sortedCourses = $unpaidCourses->merge($paidCourses);

        return view('front.category', compact('courses', 'category', 'sortedCourses'));
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
