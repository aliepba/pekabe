@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <ul class="nav nav-pills" id="myTab1" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab-1" data-toggle="tab" href="#rekap">
                    <span class="nav-icon">
                        <i class="flaticon2-chat-1"></i>
                    </span>
                    <span class="nav-text">Rekap Prakiraan SKPK</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="home-tab-2" data-toggle="tab" href="#daftar">
                    <span class="nav-icon">
                        <i class="flaticon2-chat-1"></i>
                    </span>
                    <span class="nav-text">Daftar Kegiatan PKB</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content mt-5" id="myTabContent1">
        <div class="tab-pane fade show active" id="rekap" role="tabpanel" aria-labelledby="home-tab-1">
            @include('components.table-rekap')
        </div>
        <div class="tab-pane fade show" id="daftar" role="tabpanel" aria-labelledby="home-tab-2">
            @include('components.table-kegiatan-lama')
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script>
        $(document).ready(function () {
            $('#kegiatan').DataTable();
        });
    </script>
@endpush

