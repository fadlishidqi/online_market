<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ Auth::user()->hasRole('owner') ? __('Owner Dashboard') : __('Dashboard') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @role('owner')
                <div class="item-card flex flex-col gap-y-10 md:flex-row justify-between items-center">
                    <div class="flex flex-col gap-y-3">
                        <img src="{{asset('assets/logo/courses.png')}}" alt="Courses Icon" class="w-[46px] h-[46px]">
                        <div>
                            <p class="text-slate-500 text-sm">Courses</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$courses}}</h3>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-3">
                        <img src="{{asset('assets/logo/wallets.png')}}" alt="Courses Icon" class="w-[46px] h-[46px]">
                        <div>
                            <p class="text-slate-500 text-sm">Transactions</p>
                            <h3 class="text-indigo-950 text-xl font-bold">0</h3>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-3">
                        <img src="{{asset('assets/logo/student.png')}}" alt="Courses Icon" class="w-[46px] h-[46px]">
                        <div>
                            <p class="text-slate-500 text-sm">Students</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$students}}</h3>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-3">
                        <img src="{{asset('assets/logo/teacher.png')}}" alt="Courses Icon" class="w-[46px] h-[46px]">
                        <div>
                            <p class="text-slate-500 text-sm">Teachers</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$teachers}}</h3>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-3">
                        <img src="{{asset('assets/logo/kategori.png')}}" alt="Courses Icon" class="w-[46px] h-[46px]">
                        <div>
                            <p class="text-slate-500 text-sm">Categories</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$categories}}</h3>
                        </div>
                    </div>
                </div>
                @endrole
                
                <!-- Fitur untuk Student -->
                @role('student')
                @if($paidCourses->isNotEmpty())
                    <h3 class="text-indigo-950 font-bold text-2xl">Your Purchased Courses</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($paidCourses as $course)
                            <div class="course-card w-full px-3 pb-[70px] mt-[2px]">
                                <div class="flex flex-col rounded-t-[12px] rounded-b-[24px] gap-[30px] bg-white w-full pb-[10px] overflow-hidden transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">
                                    <a href="{{ route('front.details', $course->slug) }}" class="thumbnail w-full h-[200px] shrink-0 rounded-[10px] overflow-hidden">
                                        <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
                                    </a>
                                    <div class="flex flex-col px-4 gap-[10px]">
                                        <a href="{{ route('front.details', $course->slug) }}" class="font-semibold text-lg line-clamp-2 hover:line-clamp-none min-h-[40px]">{{ $course->name }}</a>
                                        <div class="flex items-center gap-2">
                                            <p class="text-lg font-semibold" style="color: rgb(7, 141, 7);">JOINED</p>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-[2px]">
                                                @for ($i = 0; $i < 5; $i++)
                                                    <div>
                                                        <img src="assets/icon/star.svg" alt="star">
                                                    </div>
                                                @endfor
                                            </div>
                                            <p class="text-right text-[#6D7786]">{{ $course->students->count() }} students</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                                                <img src="{{ Storage::url($course->teacher->user->avatar) }}" class="w-full h-full object-cover" alt="icon">
                                            </div>
                                            <div class="flex flex-col">
                                                <p class="font-semibold">{{ $course->teacher->user->name }}</p>
                                                <p class="text-[#6D7786]">{{ $course->teacher->user->occupation }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h3 class="text-indigo-950 font-bold text-2xl">Upgrade Skills Today</h3>
                    <p class="text-slate-500 text-base">
                        Grow your career with experienced teachers in Alqowy Class.
                    </p>
                    <a href="{{route('front.index')}}" class="w-fit font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                        Explore Catalog
                    </a>
                @endif
            @endrole
            </div>
        </div>
    </div>
</x-app-layout>
