<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{route('admin.categories.create')}}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse ($categories as $category)
                <div class="item-card rounded-lg">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-1">
                            <img src="{{Storage::url($category->icon)}}" alt="" class="rounded-2xl 
                            object-cover w-[70px] h-[70px]">
                        </div>
                        <div class="col-span-5">
                            <h3 class="text-indigo-950 text-xl font-bold">{{$category->name}}</h3>
                        </div>
                        <div class="col-span-3">
                            <p class="text-slate-500 text-sm">Date</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{$category->created_at}}</h3>
                        </div>
                        <div class="col-span-3 text-right">
                            <a href="{{route('admin.categories.edit', $category)}}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full inline-block">
                                Edit
                            </a>
                            <form action="{{route('admin.categories.destroy', $category)}}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-bold py-2 px-4 bg-red-700 text-white rounded-full">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500">Tidak Ada Kategori</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
