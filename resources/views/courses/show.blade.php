@extends('layouts.app')
@section('title', 'Detail Kursus')

@section('content')
<style>
.detail-wrap{
    --primary:#7c3aed; --primary-dark:#5b21b6; --primary-light:#ede9fe;
    --accent:#f472b6; --bg:#faf5ff; --text:#2e1065; --muted:#6b5b8f; --border:#e9d5ff;
    max-width:860px; margin:40px auto 60px; padding:0 16px;
    font-family:"Segoe UI",system-ui,Roboto,Arial,sans-serif; color:var(--text);
}
.detail-wrap *{box-sizing:border-box}
.detail-wrap .flash-ok{margin:0 0 16px;padding:12px 16px;color:#166534;background:#dcfce7;border:1px solid #86efac;border-radius:12px}
.detail-wrap .crumb{display:flex;gap:8px;margin:0 0 14px;font-size:.92rem;color:var(--muted)}
.detail-wrap .crumb a{color:var(--primary);text-decoration:none;font-weight:600}
.detail-wrap .detail-card{background:#fff;border:1px solid var(--border);border-top:5px solid var(--primary);border-radius:22px;box-shadow:0 20px 50px rgba(91,33,182,.15);overflow:hidden}
.detail-wrap .detail-header{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;padding:32px;background:linear-gradient(135deg,var(--primary-light),#fff 70%);border-bottom:1px solid var(--border)}
.detail-wrap .detail-code{display:inline-block;padding:3px 14px;font-size:.85rem;font-weight:700;color:#fff;background:linear-gradient(90deg,var(--primary),var(--accent));border-radius:999px}
.detail-wrap .detail-header h1{margin:12px 0 4px;font-size:2rem;line-height:1.2;color:var(--primary-dark)}
.detail-wrap .detail-header p{margin:0;color:var(--muted)}
.detail-wrap .status-pill{padding:8px 20px;font-weight:700;font-size:.9rem;border-radius:999px;border:1px solid transparent}
.detail-wrap .status-draft{color:#92400e;background:#fef3c7;border-color:#fcd34d}
.detail-wrap .status-open{color:#166534;background:#dcfce7;border-color:#86efac}
.detail-wrap .status-closed{color:#991b1b;background:#fee2e2;border-color:#fca5a5}
.detail-wrap .detail-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;padding:28px 32px 8px}
.detail-wrap .stat{padding:20px;text-align:center;background:var(--bg);border:1px solid var(--border);border-radius:16px;transition:transform .2s,box-shadow .2s}
.detail-wrap .stat:hover{transform:translateY(-4px);box-shadow:0 12px 26px rgba(124,58,237,.18)}
.detail-wrap .stat-icon{font-size:1.6rem;margin-bottom:4px}
.detail-wrap .stat-label{font-size:.85rem;color:var(--muted);font-weight:600}
.detail-wrap .stat-value{margin-top:2px;font-size:1.15rem;font-weight:800;color:var(--primary-dark)}
.detail-wrap .detail-body{padding:24px 32px 28px}
.detail-wrap .detail-body h2{margin:0 0 8px;font-size:1.1rem;color:var(--primary-dark)}
.detail-wrap .detail-body p{margin:0;padding:16px 18px;background:var(--bg);border-left:4px solid var(--accent);border-radius:0 12px 12px 0;white-space:pre-line}
.detail-wrap .detail-actions{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;padding:20px 32px;background:var(--bg);border-top:1px solid var(--border)}
.detail-wrap .actions-right{display:flex;gap:10px;flex-wrap:wrap}
.detail-wrap .actions-right form{margin:0}
.detail-wrap .btn-main,.detail-wrap .btn-ghost,.detail-wrap .btn-danger{display:inline-block;padding:11px 24px;font:inherit;font-weight:700;text-decoration:none;border-radius:999px;cursor:pointer;transition:transform .15s,box-shadow .15s,background .15s,color .15s}
.detail-wrap .btn-main{color:#fff;border:0;background:linear-gradient(90deg,#7c3aed,#a855f7);box-shadow:0 8px 20px rgba(124,58,237,.35)}
.detail-wrap .btn-main:hover{transform:translateY(-2px);box-shadow:0 12px 26px rgba(124,58,237,.5)}
.detail-wrap .btn-ghost{color:var(--primary-dark);background:#fff;border:1px solid var(--border)}
.detail-wrap .btn-ghost:hover{background:var(--primary-light)}
.detail-wrap .btn-danger{color:#dc2626;background:#fff;border:1px solid #fca5a5}
.detail-wrap .btn-danger:hover{color:#fff;background:#dc2626;border-color:#dc2626}
@media (max-width:700px){
    .detail-wrap .detail-stats{grid-template-columns:1fr;padding:20px}
    .detail-wrap .detail-header,.detail-wrap .detail-body,.detail-wrap .detail-actions{padding-left:20px;padding-right:20px}
    .detail-wrap .detail-actions{flex-direction:column;align-items:stretch}
    .detail-wrap .actions-right>*{flex:1;text-align:center}
}
</style>

<div class="detail-wrap">

    @if (session('success'))
        <div class="flash-ok">{{ session('success') }}</div>
    @endif

    <nav class="crumb">
        <a href="{{ route('courses.index') }}">Daftar Kursus</a>
        <span>/</span>
        <span>{{ $course->code }}</span>
    </nav>

    <div class="detail-card">

        <div class="detail-header">
            <div>
                <span class="detail-code">{{ $course->code }}</span>
                <h1>{{ $course->name }}</h1>
                <p>Detail lengkap informasi kursus</p>
            </div>
            <span class="status-pill status-{{ $course->status }}">{{ ucfirst($course->status) }}</span>
        </div>

        <div class="detail-stats">
            <div class="stat">
                <div class="stat-icon">💰</div>
                <div class="stat-label">Biaya</div>
                <div class="stat-value">Rp {{ number_format($course->fee, 0, ',', '.') }}</div>
            </div>
            <div class="stat">
                <div class="stat-icon">👥</div>
                <div class="stat-label">Kuota</div>
                <div class="stat-value">{{ $course->quota }} peserta</div>
            </div>
            <div class="stat">
                <div class="stat-icon">📅</div>
                <div class="stat-label">Tanggal Mulai</div>
                <div class="stat-value">{{ $course->start_date?->format('d-m-Y') ?? '-' }}</div>
            </div>
        </div>

        <div class="detail-body">
            <h2>Deskripsi</h2>
            <p>{{ $course->description ?: 'Belum ada deskripsi untuk kursus ini.' }}</p>
        </div>

        <div class="detail-actions">
            <a href="{{ route('courses.index') }}" class="btn-ghost">← Kembali</a>

            <div class="actions-right">
                <a href="{{ route('courses.edit', $course) }}" class="btn-main">✏️ Edit</a>

                <form method="POST"
                      action="{{ route('courses.destroy', $course) }}"
                      onsubmit="return confirm('Hapus kursus ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">🗑 Hapus</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection