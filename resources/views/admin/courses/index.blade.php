<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Courses') }}
            </h2>
            <a href="{{route('admin.courses.create')}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse ($courses as $course)
                <div class="grid grid-cols-12 gap-10 items-center">
                    <div class="col-span-12 md:col-span-4 flex items-center gap-x-6">
                        <img src="{{Storage::url($course->thumbnail)}}" alt="" class="rounded-2xl object-cover w-[70px] h-[70px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{$course->name}}</h3>
                            <p class="text-slate-500 text-sm font-semibold">{{$course->category->name}}</p>
                            <p class="text-slate-700 text-sm font-semibold">Rp. {{ number_format($course->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="col-span-4 md:col-span-2 hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Students</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{$course->students->count()}}</h3>
                    </div>
                    <div class="col-span-4 md:col-span-2 hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Videos</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{$course->course_videos->count()}}</h3>
                    </div>
                    <div class="col-span-4 md:col-span-2 hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Teacher</p>
                        <h3 class="text-indigo-950 text-xl font-bold">{{$course->teacher->user->name}}</h3>
                    </div>
                    <div class="col-span-12 md:col-span-2 flex justify-end items-center gap-x-3">
                        <a href="{{route('admin.courses.show', $course)}}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                            Manage
                        </a>
                        <form action="{{route('admin.courses.destroy', $course)}}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-2 px-4 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>                    
                </div>  
                @empty
                <p class="text-center text-gray-500">Tidak Ada Course</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
