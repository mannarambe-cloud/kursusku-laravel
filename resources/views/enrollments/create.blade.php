@extends('layouts.app')

@section('title', 'Pendaftaran Kursus')

@section('content')
<form method="POST" action="{{ route('enrollments.preview') }}" class="form-box" id="enrollment-form">
    @csrf

    <h1>Pendaftaran Kursus</h1>
    <p class="hint">Pilih kursus. Jumlah kursi akan dicek tanpa reload halaman.</p>

    <label for="name">Nama</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}"
           class="{{ $errors->has('name') ? 'has-error' : '' }}">
    @error('name')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}"
           class="{{ $errors->has('email') ? 'has-error' : '' }}">
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="course_id">Pilih Kursus</label>
    <select id="course_id" name="course_id"
            class="{{ $errors->has('course_id') ? 'has-error' : '' }}">
        <option value="">-- pilih kursus --</option>
        @foreach ($courses as $id => $course)
            <option value="{{ $id }}" @selected(old('course_id') == $id)>
                {{ $course['name'] }}
            </option>
        @endforeach
    </select>
    @error('course_id')
        <div class="error">{{ $message }}</div>
    @enderror

    <div class="hint" id="availability" style="padding: 12px 14px; background: var(--primary-light); border-radius: 12px;">
        Pilih kursus untuk melihat sisa kursi.
    </div>

    <button type="submit">Kirim Pendaftaran</button>
</form>
@endsection

@push('scripts')
<script>
    const select = document.getElementById('course_id');
    const box = document.getElementById('availability');

    select.addEventListener('change', async function () {
        if (!this.value) {
            box.textContent = 'Pilih kursus untuk melihat sisa kursi.';
            return;
        }

        box.textContent = 'Memeriksa...';

        try {
            const res = await fetch('/courses/' + this.value + '/availability');
            if (!res.ok) throw new Error('Gagal');
            const data = await res.json();
            box.textContent = data.course + ': sisa ' + data.remaining + ' kursi.';
        } catch (e) {
            box.textContent = 'Gagal memeriksa ketersediaan.';
        }
    });
</script>
@endpush