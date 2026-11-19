
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Enrollment - KursusKu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f3fb;
            color: #292442;
            padding: 35px;
        }

        .container {
            max-width: 1150px;
            margin: auto;
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #6c3bd1, #9670ed);
            color: white;
            padding: 35px;
            border-radius: 18px;
            margin-bottom: 30px;
            box-shadow: 0 8px 20px rgba(108, 59, 209, 0.18);
        }

        .header h1 {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 15px;
            opacity: 0.9;
        }

        /* CARD */
        .card {
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.05);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .card-header h2 {
            font-size: 21px;
            color: #30234d;
        }

        .card-header p {
            color: #888;
            font-size: 13px;
            margin-top: 6px;
        }

        /* BUTTON */
        .btn-tambah {
            background: #7045d6;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-tambah:hover {
            background: #5630b2;
            transform: translateY(-2px);
        }

        /* TABLE */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        thead {
            background: #f0ebfc;
        }

        th {
            color: #6740b8;
            font-size: 14px;
            text-align: left;
            padding: 17px;
        }

        td {
            padding: 18px 17px;
            border-bottom: 1px solid #eeeaf5;
            font-size: 14px;
            color: #555;
        }

        tbody tr:hover {
            background: #faf8ff;
        }

        /* STATUS */
        .status {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 20px;
            background: #eee8ff;
            color: #7045d6;
            font-size: 12px;
            font-weight: bold;
        }

        /* EMPTY DATA */
        .empty {
            text-align: center;
            padding: 35px;
            color: #999;
        }

        /* SUCCESS MESSAGE */
        .success {
            background: #e5f8ec;
            color: #25834a;
            padding: 14px 18px;
            border-radius: 9px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #999;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .header {
                padding: 25px 20px;
            }

            .header h1 {
                font-size: 23px;
            }

            .card {
                padding: 18px;
            }

            .card-header {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>📚 Laporan Enrollment KursusKu</h1>
        <p>Kelola dan pantau data pendaftaran peserta kursus dengan mudah.</p>
    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- CONTENT -->
    <div class="card">

        <div class="card-header">
            <div>
                <h2>📋 Data Enrollment</h2>
                <p>Daftar peserta yang telah mendaftar kursus.</p>
            </div>

            <a href="{{ route('enrollments.create') }}" class="btn-tambah">
                + Tambah Enrollment
            </a>
        </div>

        <!-- TABLE -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Participant</th>
                        <th>Course</th>
                        <th>Start Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($enrollments as $enrollment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>
                                    {{ $enrollment->participant->name }}
                                </strong>
                            </td>

                            <td>
                                {{ $enrollment->course->name }}
                            </td>

                            <td>
                                {{ $enrollment->course->start_date
                                    ? $enrollment->course->start_date->format('d M Y')
                                    : '-' }}
                            </td>

                            <td>
                                <span class="status">
                                    {{ ucfirst(str_replace('_', ' ', $enrollment->status)) }}
                                </span>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="empty">
                                📭 Belum ada enrollment.
                                <br><br>
                                Silakan tambahkan enrollment baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <div class="footer">
        © 2026 KursusKu | Sistem Informasi Pendaftaran Kursus
    </div>

</div>

</body>
</html>
