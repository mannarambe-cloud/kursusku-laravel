@extends('layouts.app')

@section('title', 'Tambah Kursus')

@section('content')
<style>
  .kf-wrap { max-width: 760px; margin: 32px auto 60px; }
  .kf-wrap h1 { margin: 0; font-size: 1.6rem; font-weight: 800; color: #1e1b4b; }
  .kf-sub { margin: 4px 0 20px; color: #6b7280; font-size: .95rem; }

  .kf-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 8px 24px rgba(79, 70, 229, .08);
  }
  .kf-group { margin-bottom: 18px; }
  .kf-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }

  .kf-card label {
    display: block;
    margin: 0 0 6px;
    font-size: .85rem;
    font-weight: 600;
    color: #374151;
  }
  .kf-card input,
  .kf-card textarea,
  .kf-card select {
    display: block;
    width: 100%;
    padding: 11px 14px;
    font: inherit;
    font-size: .95rem;
    color: #111827;
    background: #f9fafb;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    transition: border-color .2s, box-shadow .2s, background .2s;
  }
  .kf-card textarea { min-height: 110px; resize: vertical; }
  .kf-card input::placeholder,
  .kf-card textarea::placeholder { color: #9ca3af; }
  .kf-card input:focus,
  .kf-card textarea:focus,
  .kf-card select:focus {
    outline: none;
    background: #fff;
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, .18);
  }
  .kf-error { margin-top: 4px; font-size: .85rem; color: #dc2626; }

  .kf-actions {
    display: flex;
    gap: 10px;
    margin-top: 8px;
    padding-top: 20px;
    border-top: 1px solid #e5e7eb;
  }
  .kf-btn {
    display: inline-block;
    width: auto !important;
    padding: 11px 24px;
    font: inherit;
    font-size: .95rem;
    font-weight: 700;
    text-align: center;
    text-decoration: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background .2s, transform .1s;
  }
  .kf-btn-primary {
    color: #fff;
    background: #4f46e5;
    border: 0;
    box-shadow: 0 6px 16px rgba(79, 70, 229, .35);
  }
  .kf-btn-primary:hover { background: #4338ca; }
  .kf-btn-light {
    color: #4338ca;
    background: #fff;
    border: 1px solid #e5e7eb;
  }
  .kf-btn-light:hover { background: #eef2ff; }

  @media (max-width: 600px) { .kf-row { grid-template-columns: 1fr; } }
</style>

<div class="kf-wrap">
  <h1>Tambah Kursus</h1>
  <p class="kf-sub">Isi data kursus baru, lalu klik Simpan.</p>

  <form method="POST" action="{{ route('courses.store') }}" class="kf-card">
    @csrf

    <div class="kf-group">
      <label for="code">Kode Kursus</label>
      <input id="code" name="code" value="{{ old('code') }}"
             maxlength="20" placeholder="Contoh: WEB-101" required>
      @error('code') <div class="kf-error">{{ $message }}</div> @enderror
    </div>

    <div class="kf-group">
      <label for="name">Nama Kursus</label>
      <input id="name" name="name" value="{{ old('name') }}"
             maxlength="120" placeholder="Contoh: Web Dasar" required>
      @error('name') <div class="kf-error">{{ $message }}</div> @enderror
    </div>

    <div class="kf-group">
      <label for="description">Deskripsi</label>
      <textarea id="description" name="description"
                placeholder="Deskripsi singkat kursus">{{ old('description') }}</textarea>
      @error('description') <div class="kf-error">{{ $message }}</div> @enderror
    </div>

    <div class="kf-row">
      <div class="kf-group">
        <label for="fee">Biaya (Rp)</label>
        <input id="fee" type="number" name="fee"
               value="{{ old('fee', 0) }}" min="0" required>
        @error('fee') <div class="kf-error">{{ $message }}</div> @enderror
      </div>

      <div class="kf-group">
        <label for="quota">Kuota Peserta</label>
        <input id="quota" type="number" name="quota"
               value="{{ old('quota', 20) }}" min="1" max="500" required>
        @error('quota') <div class="kf-error">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="kf-row">
      <div class="kf-group">
        <label for="start_date">Tanggal Mulai</label>
        <input id="start_date" type="date" name="start_date"
               value="{{ old('start_date') }}" required>
        @error('start_date') <div class="kf-error">{{ $message }}</div> @enderror
      </div>

      <div class="kf-group">
        <label for="status">Status</label>
        <select id="status" name="status" required>
          <option value="draft"  @selected(old('status', 'draft') === 'draft')>Draft</option>
          <option value="open"   @selected(old('status') === 'open')>Open</option>
          <option value="closed" @selected(old('status') === 'closed')>Closed</option>
        </select>
        @error('status') <div class="kf-error">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="kf-actions">
      <button type="submit" class="kf-btn kf-btn-primary">Simpan Kursus</button>
      <a href="{{ route('courses.index') }}" class="kf-btn kf-btn-light">Batal</a>
    </div>
  </form>
</div>
@endsection