@extends('layouts.master')

@section("title", "Création d'une instruction")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers arrivés</h3>
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
                            <h3 class="m-0">Création d'une instruction</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('type-instruction.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Code</label>
                                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="inputEmail4">
                                    @error('code')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="inputPassword4">Libellé</label>
                                    <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror" id="inputPassword4">
                                    @error('libelle')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Créer</button>
                            <a href="{{ route('type-instruction.index') }}" class="btn btn-danger ms-5">Annuler</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
