@extends('admin.layout.default')

@section('title', 'ID Picture')

@section('body')

    <div class="container-xl">

        <div class="card">

            <div class="card-header">
                <i class="fa fa-qrcode"></i>ID Picture of {{ $resident->name }}
            </div>

            <div class="card-body">

                <img src="{{ $resident->id_picture }}" alt="ID Picture" width="500" height="500" />

            </div>

        </div>

    </div>

@endsection