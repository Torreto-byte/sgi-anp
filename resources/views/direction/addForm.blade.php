@extends('layouts.master')

@section("title", "Ajout d'une direction")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des directions</h3>
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
                            <h3 class="m-0">Ajout d'une nouvelle direction</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('direction.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Nom de la direction</label>
                                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" id="inputEmail4">
                                    @error('nom')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="inputPassword4">Sigle</label>
                                    <input type="text" name="sigle" class="form-control @error('sigle') is-invalid @enderror" id="inputPassword4">
                                    @error('sigle')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('direction.index') }}" class="btn btn-danger ms-5">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
