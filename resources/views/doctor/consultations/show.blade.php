@extends('doctor.layouts.app')

@section('title', 'Consultation Details')
@section('page-title', 'Consultation Details')

@section('content')
<div class="grid grid-cols-3 gap-6">
    <!-- Main Information -->
    <div class="col-span-2 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-6">Consultation Information</h3>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-sm text-gray-500 mb-1">Patient Name</p>
                <p class="text-lg font-semibold text-gray-900">{{ $consultation->patient->nama ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Phone Number</p>
                <p class="text-lg font-semibold text-gray-900">{{ $consultation->patient->no_hp ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Consultation Date & Time</p>
                <p class="text-lg font-semibold text-gray-900">{{ $consultation->consultation_datetime->format('d F Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 mb-1">Status</p>
                @php
                    $statusColors = [
                        'pending' => 'yellow',
                        'confirmed' => 'blue',
                        'completed' => 'green',
                        'cancelled' => 'red',
                    ];
                    $color = $statusColors[$consultation->status] ?? 'gray';
                @endphp
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-{{ $color }}-100 text-{{ $color }}-800">
                    {{ ucfirst($consultation->status) }}
                </span>
            </div>
        </div>

        <hr class="my-6">

        <div class="mb-6">
            <p class="text-sm text-gray-500 mb-2">Patient Notes</p>
            <p class="text-gray-900 bg-gray-50 p-4 rounded">
                {{ $consultation->notes ?? 'No notes provided' }}
            </p>
        </div>

        @if($consultation->doctor_notes)
        <div class="mb-6">
            <p class="text-sm text-gray-500 mb-2">Doctor Notes</p>
            <p class="text-gray-900 bg-blue-50 p-4 rounded border border-blue-200">
                {{ $consultation->doctor_notes }}
            </p>
        </div>
        @endif

        <div class="flex space-x-3">
            <a href="{{ route('doctor.consultations.edit', $consultation) }}" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center font-semibold">
                Update Status
            </a>
            <a href="{{ route('doctor.consultations.index') }}" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-center font-semibold">
                Back
            </a>
        </div>
    </div>

    <!-- Side Information -->
    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Fee Information</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Consultation Fee:</span>
                    <span class="font-semibold text-gray-900">Rp {{ number_format($consultation->doctor->consultation_fee, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Fee Paid:</span>
                    <span class="font-semibold text-gray-900">{{ $consultation->fee_paid ? 'Rp ' . number_format($consultation->fee_paid, 0, ',', '.') : 'Pending' }}</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Patient Information</h3>
            <div class="space-y-2">
                <div>
                    <p class="text-xs text-gray-500">Email</p>
                    <p class="text-sm text-gray-900">{{ $consultation->patient->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Address</p>
                    <p class="text-sm text-gray-900">{{ $consultation->patient->alamat ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
