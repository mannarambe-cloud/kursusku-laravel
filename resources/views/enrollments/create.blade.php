<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Enrollment</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
        }

        .container {
            width: 100%;
            max-width: 650px;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .icon {
            width: 85px;
            height: 85px;
            background: #eeeaff;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            margin: 0 auto 18px;
        }

        h1 {
            color: #312e81;
            font-size: 30px;
            margin-bottom: 10px;
        }

        .header p {
            color: #888;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            font-size: 17px;
        }

        select {
            width: 100%;
            padding: 16px;
            border: 1px solid #ddd;
            border-radius: 12px;
            font-size: 15px;
            outline: none;
            background: #fafafa;
            cursor: pointer;
        }

        select:focus {
            border-color: #764ba2;
            box-shadow: 0 0 5px rgba(118,75,162,0.2);
        }

        .btn {
            width: 100%;
            padding: 17px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 15px rgba(102,126,234,0.3);
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #764ba2;
            text-decoration: none;
            font-size: 15px;
        }

        .back:hover {
            text-decoration: underline;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 7px;
        }

        .alert {
            background: #fee2e2;
            color: #b91c1c;
            padding: 13px;
            border-radius: 10px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .notice {
            background: #fff7ed;
            color: #c2410c;
            padding: 13px;
            border-radius: 10px;
            margin-top: 10px;
            font-size: 13px;
        }

        @media(max-width: 500px) {
            .container {
                padding: 25px 20px;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <div class="icon">📚</div>

        <h1>Tambah Enrollment</h1>

        <p>
            Silakan pilih participant dan course
            yang ingin didaftarkan.
        </p>
    </div>

    <!-- Pesan Error -->
    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- Form Enrollment -->
    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf

        <!-- Participant -->
        <div class="form-group">

            <label for="participant_id">
                👤 Participant
            </label>

            <select
                name="participant_id"
                id="participant_id"
                required
            >
                <option value="">-- Pilih Participant --</option>

                @foreach ($participants as $participant)
                    <option
                        value="{{ $participant->id }}"
                        {{ old('participant_id') == $participant->id ? 'selected' : '' }}
                    >
                        {{ $participant->name }}
                    </option>
                @endforeach

            </select>

            @error('participant_id')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>

        <!-- Course -->
        <div class="form-group">

            <label for="course_id">
                📖 Course
            </label>

            <select
                name="course_id"
                id="course_id"
                required
            >
                <option value="">-- Pilih Course --</option>

                @foreach ($courses as $course)
                    <option
                        value="{{ $course->id }}"
                        {{ old('course_id') == $course->id ? 'selected' : '' }}
                    >
                        {{ $course->name }}
                    </option>
                @endforeach

            </select>

            @if ($courses->isEmpty())
                <div class="notice">
                    Belum ada Course yang aktif.
                    Silakan aktifkan Course terlebih dahulu.
                </div>
            @endif

            @error('course_id')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>

        <!-- Tombol Simpan -->
        <button
            type="submit"
            class="btn"
            {{ $courses->isEmpty() ? 'disabled' : '' }}
        >
            + Simpan Enrollment
        </button>

    </form>

    <!-- Tombol Kembali -->
    <a href="{{ route('enrollments.index') }}" class="back">
        ← Kembali ke Daftar Enrollment
    </a>

</div>

</body>
</html>