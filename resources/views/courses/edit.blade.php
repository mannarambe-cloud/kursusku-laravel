<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kursus - KursusKu</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* CSS kamu belum punya style untuk textarea */
        .form-box textarea {
            width: 100%;
            min-height: 100px;
            padding: 11px 14px;
            font: inherit;
            color: var(--text);
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            resize: vertical;
        }
        .form-box textarea:focus { outline: 2px solid var(--primary); border-color: transparent; }
        .form-box textarea.has-error { border-color: #dc2626; }
        .form-box .cancel { text-align: center; margin-top: 14px; }
        .form-box .cancel a { color: var(--muted); text-decoration: none; font-weight: 600; }
        .form-box .cancel a:hover { color: var(--primary); }
    </style>
</head>
<body>

<header class="navbar">
    <div class="container">
        <strong>KursusKu</strong>
        <nav>
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ route('courses.index') }}" class="active">Kursus</a>
            <a href="{{ route('courses.create') }}">Tambah Kursus</a>
        </nav>
    </div>
</header>

<main class="container">
    <div class="form-box">
        <h1>Edit Kursus</h1>

        <form action="{{ route('courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="code">Kode</label>
            <input type="text" id="code" name="code" maxlength="20"
                   value="{{ old('code', $course->code) }}"
                   @class(['has-error' => $errors->has('code')])>
            @error('code') <div class="error">{{ $message }}</div> @enderror

            <label for="name">Nama Kursus</label>
            <input type="text" id="name" name="name" maxlength="120"
                   value="{{ old('name', $course->name) }}"
                   @class(['has-error' => $errors->has('name')])>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label for="description">Deskripsi</label>
            <textarea id="description" name="description"
                      @class(['has-error' => $errors->has('description')])>{{ old('description', $course->description) }}</textarea>
            @error('description') <div class="error">{{ $message }}</div> @enderror

            <label for="fee">Biaya (Rp)</label>
            <input type="number" id="fee" name="fee" min="0"
                   value="{{ old('fee', $course->fee) }}"
                   @class(['has-error' => $errors->has('fee')])>
            @error('fee') <div class="error">{{ $message }}</div> @enderror

            <label for="quota">Kuota</label>
            <input type="number" id="quota" name="quota" min="1" max="500"
                   value="{{ old('quota', $course->quota) }}"
                   @class(['has-error' => $errors->has('quota')])>
            <div class="hint">Maksimal 500 peserta.</div>
            @error('quota') <div class="error">{{ $message }}</div> @enderror

            <label for="start_date">Tanggal Mulai</label>
            <input type="date" id="start_date" name="start_date"
                   value="{{ old('start_date', \Illuminate\Support\Carbon::parse($course->start_date)->format('Y-m-d')) }}"
                   @class(['has-error' => $errors->has('start_date')])>
            @error('start_date') <div class="error">{{ $message }}</div> @enderror

            <label for="status">Status</label>
            <select id="status" name="status" @class(['has-error' => $errors->has('status')])>
                @foreach (['draft' => 'Draft', 'open' => 'Open', 'closed' => 'Closed'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $course->status) === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('status') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Simpan Perubahan</button>

            <div class="cancel"><a href="{{ route('courses.index') }}">Batal</a></div>
        </form>
    </div>
</main>

</body>
</html>