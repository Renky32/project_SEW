@extends('doctor.layouts.app')

@section('title', 'Edit Schedule')
@section('page-title', 'Edit Schedule')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('doctor.schedules.update', $schedule) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="day_of_week" class="block text-sm font-semibold text-gray-700 mb-2">Day of Week</label>
                <select name="day_of_week" id="day_of_week" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('day_of_week') border-red-500 @enderror">
                    <option value="">Select a day</option>
                    @foreach($daysOfWeek as $day)
                        <option value="{{ $day }}" {{ old('day_of_week', $schedule->day_of_week) === $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
                @error('day_of_week')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-2">Start Time</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $schedule->start_time) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('start_time') border-red-500 @enderror">
                    @error('start_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-2">End Time</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $schedule->end_time) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('end_time') border-red-500 @enderror">
                    @error('end_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="max_consultations" class="block text-sm font-semibold text-gray-700 mb-2">Max Consultations per Day</label>
                <input type="number" name="max_consultations" id="max_consultations" value="{{ old('max_consultations', $schedule->max_consultations) }}" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('max_consultations') border-red-500 @enderror">
                @error('max_consultations')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                    <option value="active" {{ old('status', $schedule->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $schedule->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                    Update Schedule
                </button>
                <a href="{{ route('doctor.schedules.index') }}" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
