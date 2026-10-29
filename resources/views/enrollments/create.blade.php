@extends('layouts.app')

@section('title', 'Pendaftaran Kursus')

@section('content')
    <div class="form-box">
        <h1>Pendaftaran Kursus</h1>

        <form action="{{ route('enrollments.preview') }}" method="POST" novalidate>
            @csrf

            <label for="name">Nama</label>
            <input type="text" id="name" name="name"
                   class="{{ $errors->has('name') ? 'has-error' : '' }}"
                   value="{{ old('name') }}">
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                   class="{{ $errors->has('email') ? 'has-error' : '' }}"
                   value="{{ old('email') }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label for="course_id">Kursus</label>
            <select id="course_id" name="course_id"
                    class="{{ $errors->has('course_id') ? 'has-error' : '' }}">
                <option value="">-- Pilih kursus --</option>
                @foreach ($courses as $id => $course)
                    <option value="{{ $id }}" @selected(old('course_id') == $id)>
                        {{ $course['name'] }}
                    </option>
                @endforeach
            </select>
            @error('course_id') <div class="error">{{ $message }}</div> @enderror
            <div id="availability" class="hint"></div>

            <button type="submit">Kirim</button>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    const select = document.getElementById('course_id');
    const info = document.getElementById('availability');
    const urlTemplate = @json(route('courses.availability', ['course' => '__ID__']));

    async function loadAvailability() {
        const id = select.value;

        if (!id) {
            info.textContent = '';
            return;
        }

        info.textContent = 'Memeriksa ketersediaan...';

        try {
            const response = await fetch(urlTemplate.replace('__ID__', id), {
                headers: { 'Accept': 'application/json' },
            });

            if (!response.ok) throw new Error('Gagal memuat data');

            const data = await response.json();
            info.textContent = `Sisa kuota ${data.course}: ${data.remaining} kursi`;
        } catch (e) {
            info.textContent = 'Tidak dapat memuat ketersediaan.';
        }
    }

    select.addEventListener('change', loadAvailability);
    loadAvailability();
</script>
@endpush