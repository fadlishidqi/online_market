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
                
                @role('student')
                <h3 class="text-indigo-950 font-bold text-2xl">Upgrade Skills Today</h3>
                <p class="text-slate-500 text-base">
                    Grow your career with experienced teachers in Alqowy Class.
                </p>
                <a href="{{route('front.index')}}" class="w-fit font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                    Explore Catalog
                </a>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
