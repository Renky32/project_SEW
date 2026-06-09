@extends('doctor.layouts.app')

@section('title', 'My Schedules')
@section('page-title', 'My Schedules')

@section('content')
<div class="mb-6">
    <a href="{{ route('doctor.schedules.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add New Schedule
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($schedules as $schedule)
        <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $schedule->day_of_week }}</h3>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $schedule->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($schedule->status) }}
                    </span>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $schedule->start_time }} - {{ $schedule->end_time }}</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10h.01M11 20h.01M15 16h.01M5.604 20h7.753a2 2 0 002-2v-1a6 6 0 00-6-6H9a6 6 0 00-6 6v1a2 2 0 002 2z" />
                        </svg>
                        <span>Max {{ $schedule->max_consultations }} consultations</span>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <a href="{{ route('doctor.schedules.edit', $schedule) }}" class="flex-1 px-3 py-2 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 text-center text-sm font-semibold">
                        Edit
                    </a>
                    <form action="{{ route('doctor.schedules.destroy', $schedule) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this schedule?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-3 py-2 bg-red-50 text-red-600 rounded hover:bg-red-100 text-sm font-semibold">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="text-gray-500 text-lg mb-4">No schedules yet</p>
            <a href="{{ route('doctor.schedules.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Your First Schedule
            </a>
        </div>
    @endforelse
</div>
@endsection
