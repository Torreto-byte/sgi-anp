@extends('layouts.master')

@section("title", "Ouverture d'un nouveau chrono")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers départs</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h3 class="m-0">Ouverture d'un nouveau chrono</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('chrono-depart.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label text-bold fs-5 text-red-600" for="inputEmail4">Numéro du chrono</label>
                                    <input type="text" name="numero" class="form-control @error('numero') is-invalid @enderror" id="inputEmail4" placeholder="Exemple:. N°02 ">
                                    @error('numero')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Début</label>
                                    <input type="text" name="debut" class="form-control @error('debut') is-invalid @enderror" id="inputEmail4">
                                    @error('debut')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class=" col-md-6">
                                    <label class="form-label" for="inputPassword4">Fin</label>
                                    <input type="text" name="fin" class="form-control @error('fin') is-invalid @enderror" id="inputPassword4">
                                    @error('fin')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                            </div>

                            <button type="submit" class="btn btn-primary">Ouvrir</button>
                            <a href="{{ route('chrono-depart.index') }}" class="btn btn-danger ms-5">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
