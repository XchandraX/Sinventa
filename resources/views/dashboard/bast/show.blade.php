{{-- ? panggil file main.blade.php yang ada difolder dashboard/layout --}}
@extends('dashboard.layout.main')

{{-- ?code styling css untuk halaman detail berita acara --}}
@section('css')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .bar-code,
            .bar-code * {
                visibility: visible;
            }

            .bar-code {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }
        }
    </style>
@endsection
