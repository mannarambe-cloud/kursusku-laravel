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
                                <td>{{ $course->code }}</td>
                                <td>{{ $course->name }}</td>

                                <td>
                                    @if ($course->status === 'open')
                                        <span class="badge bg-success">Open</span>
                                    @elseif ($course->status === 'closed')
                                        <span class="badge bg-danger">Closed</span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($course->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex gap-1 flex-wrap">

                                        <a href="{{ route('courses.show', $course) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Detail
                                        </a>

                                        <a href="{{ route('courses.edit', $course) }}"
                                           class="btn btn-sm btn-outline-warning">
                                            Edit
                                        </a>

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

            <div class="course-pagination p-3">
                {{ $courses->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>