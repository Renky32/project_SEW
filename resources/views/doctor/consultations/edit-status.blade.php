@extends('doctor.layouts.app')

@section('title', 'Update Consultation Status')
@section('page-title', 'Update Consultation Status')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow p-8">
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Consultation Details</h3>
            <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">Patient:</span>
                    <span class="font-semibold">{{ $consultation->patient->nama ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Date & Time:</span>
                    <span class="font-semibold">{{ $consultation->consultation_datetime->format('d F Y, H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Current Status:</span>
                    <span class="font-semibold">{{ ucfirst($consultation->status) }}</span>
                </div>
            </div>
        </div>

        <form action="{{ route('doctor.consultations.update', $consultation) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Update Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                    <option value="">-- Select Status --</option>
                    <option value="pending" {{ old('status', $consultation->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status', $consultation->status) === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ old('status', $consultation->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('status', $consultation->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="doctor_notes" class="block text-sm font-semibold text-gray-700 mb-2">Doctor Notes (Optional)</label>
                <textarea name="doctor_notes" id="doctor_notes" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('doctor_notes') border-red-500 @enderror" placeholder="Add any notes about this consultation...">{{ old('doctor_notes', $consultation->doctor_notes) }}</textarea>
                @error('doctor_notes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                    Update Consultation
                </button>
                <a href="{{ route('doctor.consultations.show', $consultation) }}" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
