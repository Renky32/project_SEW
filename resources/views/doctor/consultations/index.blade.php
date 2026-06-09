@extends('doctor.layouts.app')

@section('title', 'Consultations')
@section('page-title', 'Consultations')

@section('content')
<div class="mb-6">
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('doctor.consultations.index') }}" class="px-4 py-2 rounded-lg {{ is_null(request('status')) ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
            All
        </a>
        <a href="{{ route('doctor.consultations.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-lg {{ request('status') === 'pending' ? 'bg-yellow-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
            Pending
        </a>
        <a href="{{ route('doctor.consultations.index', ['status' => 'confirmed']) }}" class="px-4 py-2 rounded-lg {{ request('status') === 'confirmed' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
            Confirmed
        </a>
        <a href="{{ route('doctor.consultations.index', ['status' => 'completed']) }}" class="px-4 py-2 rounded-lg {{ request('status') === 'completed' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
            Completed
        </a>
        <a href="{{ route('doctor.consultations.index', ['status' => 'cancelled']) }}" class="px-4 py-2 rounded-lg {{ request('status') === 'cancelled' ? 'bg-red-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300' }}">
            Cancelled
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    @if($consultations->isEmpty())
        <div class="p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <p class="text-gray-500 text-lg">No consultations found</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date & Time</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Patient Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Phone</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($consultations as $consultation)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $consultation->consultation_datetime->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $consultation->patient->nama ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $consultation->patient->no_hp ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm">
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
                        </td>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <a href="{{ route('doctor.consultations.show', $consultation) }}" class="text-blue-600 hover:text-blue-900 font-semibold">
                                View
                            </a>
                            <a href="{{ route('doctor.consultations.edit', $consultation) }}" class="text-orange-600 hover:text-orange-900 font-semibold">
                                Update
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $consultations->links() }}
        </div>
    @endif
</div>
@endsection
