@extends('layouts.master')

@section('title', 'Liste des utilisateurs')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des utilisateurs</h3>
                </div>
                <a href="{{ route('utilisateurs.create') }}" class="white_btn3">Ajouter un utilisateur</a>
            </div>
        </div>
    </div>

    @if (session('username') && session('userpassword'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Génération de mot de passe utilisateur</h4>
            <p>
                Voici le mot de passe par défaut généré automatiquement pour l'utilisateur : <strong style="font-size: 16px; color:black">{{ session('username') }}</strong>
            </p>
            <mark style="font-size: 20px"><strong>{{ session('userpassword') }}</strong></mark>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif


    <div class="row">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30 pt-4">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Liste des utilisateurs</h4>
                        </div>
                        <div class="QA_table mb_30">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th class="fw-bold" scope="col">NOM & PRENOMS</th>
                                        <th class="fw-bold" scope="col">NOM UTILISATEUR</th>
                                        <th class="fw-bold" scope="col">ROLE</th>
                                        <th class="fw-bold" scope="col">STATUT COMPTE</th>
                                        <th class="fw-bold" scope="col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($items->count() > 0)

                                        @foreach ( $items as $item )
                                            <tr>
                                                <td>{{ $item->full_name }} </td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{$item->name }} </td>
                                                @if ($item->statut == 1)
                                                    <td><a href="#" class="status_btn">ACTIF</a></td>
                                                @else
                                                    <td><a href="#" class="status_btn bg-danger">INACTIF</a></td>
                                                @endif
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('utilisateurs.edit', $item->id) }}" type="button" class="btn btn-outline-primary rounded-pill mb-3 me-2 f_s_13">
                                                            <i class="ti-pencil-alt f_s_14 me-2"></i>Modifier
                                                        </a>

                                                        <a onclick= "return confirm('Voulez-vous confirmer cette action ?')" href="{{ route('statutUtulisateur', $item->id) }}" type="button" class="btn btn-outline-success rounded-pill mb-3 me-2 f_s_13">
                                                            @php
                                                                if ($item->statut == 1) {
                                                                    echo '<i class="ti-lock f_s_14 me-2"></i>Bloquer';
                                                                } else {
                                                                    echo '<i class="ti-unlock f_s_14 me-2"></i>Débloquer';
                                                                }
                                                            @endphp
                                                        </a>

                                                        <a onclick= "return confirm('Voulez-vous confirmer cette action ?')" href="{{ route('resetpasswordUtulisateur', $item->id)}} " type="button" class="btn btn-outline-warning rounded-pill mb-3 me-2 f_s_13">
                                                            <i class="ti-reload btn-icon-prepend"></i>
                                                            Reset Password
                                                        </a>

                                                        <button type="submit" class="btn btn-outline-danger rounded-pill mb-3 f_s_13" data-bs-toggle="modal" data-bs-target="#exampleModalLong{{ $item->id }}">
                                                            <i class="ti-trash f_s_14 me-2"></i>Supprimer
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @else
                                        <tr><td colspan="5"><strong><h4 class="text-center" style="color: red"> Aucun enregistrement !</h4></strong></td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@foreach ( $items as $item )
    <div class="modal fade" id="exampleModalLong{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous confirmer cette action ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form method="POST" action="{{ route('utilisateurs.destroy', $item->id) }} ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-info text-white">Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
