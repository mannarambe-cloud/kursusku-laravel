@extends('layouts.app')

@section('title', 'Daftar Kursus')

@section('content')

<style>
    /* Tampilan pagination */
    .course-pagination .pagination {
        justify-content: center;
        align-items: center;
        gap: 6px;
        margin-bottom: 0;
    }

    .course-pagination .page-link {
        border: none;
        border-radius: 8px !important;
        color: #555;
        background: #f1f3f5;
        font-size: 13px;
        padding: 6px 10px;
        min-width: 32px;
        text-align: center;
        transition: 0.2s;
    }

    .course-pagination .page-link svg {
        width: 11px !important;
        height: 11px !important;
    }

    .course-pagination .page-link:hover {
        background: #0d6efd;
        color: white;
    }

    /* Halaman aktif */
    .course-pagination .page-item.active .page-link {
        background: #0d6efd;
        color: white;
    }

    /* Tombol tidak aktif */
    .course-pagination .page-item.disabled .page-link {
        color: #aaa;
        background: #f5f5f5;
    }
</style>

<div class="container py-4">

    {{-- Judul halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h1 class="h3 mb-1">Daftar Kursus</h1>

            <p class="text-muted mb-0">
                Data diambil dari MySQL melalui Eloquent.
            </p>
        </div>

        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            + Tambah Kursus
        </a>

    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form pencarian dan filter --}}
    <form method="GET"
          action="{{ route('courses.index') }}"
          class="row g-2 mb-3">

        <div class="col-md-6">
            <input
                type="search"
                id="live-search"
                name="q"
                value="{{ $search }}"
                class="form-control"
                placeholder="Cari kode atau nama kursus">
        </div>

        <div class="col-md-3">

            <select id="status-filter"
                    name="status"
                    class="form-select">

                <option value="">Semua status</option>

                <option value="open" @selected($status == 'open')>
                    Open
                </option>

                <option value="closed" @selected($status == 'closed')>
                    Closed
                </option>

                <option value="draft" @selected($status == 'draft')>
                    Draft
                </option>

            </select>

        </div>

        <div class="col-md-3 d-flex gap-2">

            <button type="submit" class="btn btn-primary">
                Cari
            </button>

            <a href="{{ route('courses.index') }}"
               class="btn btn-outline-secondary">
                Reset
            </a>

        </div>

    </form>

    {{-- Bagian hasil kursus AJAX --}}
    <div id="course-results">

        <div class="card shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-striped table-hover mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($courses as $course)

                                <tr>

                                    <td>
                                        {{ $course->code }}
                                    </td>

                                    <td>
                                        {{ $course->name }}
                                    </td>

                                    <td>

                                        @if ($course->status === 'open')

                                            <span class="badge bg-success">
                                                Open
                                            </span>

                                        @elseif ($course->status === 'closed')

                                            <span class="badge bg-danger">
                                                Closed
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ ucfirst($course->status) }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>

                                        <div class="d-flex gap-1 flex-wrap">

                                            {{-- Detail --}}
                                            <a href="{{ route('courses.show', $course) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                Detail
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('courses.edit', $course) }}"
                                               class="btn btn-sm btn-outline-warning">
                                                Edit
                                            </a>

                                            {{-- Hapus --}}
                                            <form method="POST"
                                                  action="{{ route('courses.destroy', $course) }}"
                                                  onsubmit="return confirm('Hapus kursus ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4"
                                        class="text-center text-muted py-4">

                                        Tidak ada kursus yang sesuai pencarian/filter.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="course-pagination p-3">

                    {{ $courses->withQueryString()->links('pagination::bootstrap-5') }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


{{-- JAVASCRIPT AJAX --}}
@push('scripts')

<script>
$(document).ready(function () {

    let searchTimer;

    // Fungsi memuat hasil kursus
    function loadCourses(url = '{{ route('courses.index') }}') {

        const q = $('#live-search').val();
        const status = $('#status-filter').val();

        $.get(url, {
            q: q,
            status: status,
            partial: 1
        })

        .done(function (html) {

            $('#course-results').replaceWith(html);

        })

        .fail(function () {

            console.error('Gagal memuat hasil course.');

        });

    }


    // LANGKAH 10: LIVE SEARCH DEBOUNCE 300 MS
    $(document).on('input', '#live-search', function () {

        clearTimeout(searchTimer);

        searchTimer = setTimeout(function () {

            loadCourses();

        }, 300);

    });


    // FILTER STATUS AJAX
    $(document).on('change', '#status-filter', function () {

        loadCourses();

    });


    // LANGKAH 11: AJAX PAGINATION
    $(document).on('click', '#course-results .pagination a', function (e) {

        e.preventDefault();

        const url = $(this).attr('href');

        const q = $('#live-search').val();

        const status = $('#status-filter').val();

        $.get(url, {
            q: q,
            status: status,
            partial: 1
        })

        .done(function (html) {

            $('#course-results').replaceWith(html);

        })

        .fail(function () {

            console.error('Gagal memuat halaman kursus.');

        });

    });

});
</script>

@endpush