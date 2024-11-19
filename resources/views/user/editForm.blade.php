@extends('layouts.master')

@section("title", "Modification des infos utilisateur")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des utilisateurs</h3>
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
                            <h3 class="m-0">Modification des infos utilisateur</h3>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <form method="POST" action="{{ route('utilisateurs.update', $singleData->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="inputEmail4">Nom & Prénoms</label>
                                    <input type="text" name="noms" value="{{ $singleData->full_name }}" class="form-control @error('noms') is-invalid @enderror" id="inputEmail4">
                                    @error('noms')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="inputPassword4">Nom utilisateur (Identifiant de connexion)</label>
                                    <input type="text" name="username" value="{{ $singleData->username }}" class="form-control @error('username') is-invalid @enderror" id="inputPassword4">
                                    @error('username')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-5">
                                <label class="form-label" for="inputPassword4">Rôle utilisateur</label>
                                <div class="col-md-6">
                                    <select name="role" class="form-control @error('role') is-invalid @enderror" id="inputPassword4">
                                        <option value="{{ $singleData->role_id }}">{{ $singleData->name }}</option>
                                        @foreach ($getDataRole as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label col-xl-3 col-lg-3 col-form-label text-danger">Activer l'option "Agent courrier absent"</label>
                                <div class="col-lg-9 col-xl-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="option" id="gridRadios1" value="0" checked>
                                        <label class="form-label form-check-label" for="gridRadios1">
                                            NON
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="option" id="gridRadios2" value="1">
                                        <label class="form-label form-check-label" for="gridRadios2">
                                            OUI
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('utilisateurs.index') }}" class="btn btn-danger ms-5">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
