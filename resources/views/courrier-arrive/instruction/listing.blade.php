@extends('layouts.master')

@section('title', 'Liste des Instructions')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers arrivés</h3>
                </div>
                <a href="{{ route('type-instruction.create') }}" class="white_btn3">Créer une instruction</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30 pt-4">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Liste des instructions</h4>
                        </div>
                        <div class="QA_table mb_30">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th scope="col">CODE</th>
                                        <th scope="col">LIBELLE</th>
                                        <th scope="col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($items->count() > 0)

                                        @foreach ( $items as $item )
                                            <tr>
                                                <td>{{ $item->code }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('type-instruction.edit', $item->id) }}" class="btn btn-outline-primary rounded-pill mb-3 me-2 f_s_13" title="MODIFIER" style="padding-top: 8px;">
                                                            <i class="ti-pencil-alt f_s_14 me-2"></i> Modifier
                                                        </a>
                                                        <button type="submit" class="btn btn-outline-danger rounded-pill mb-3 f_s_13" title="SUPPRIMER" data-bs-toggle="modal" data-bs-target="#exampleModalLong{{ $item->id }}">
                                                            <i class="ti-trash f_s_14 me-2"></i> Supprimer
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
                    <form method="POST" action="{{ route('type-instruction.destroy', $item->id) }} ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-info text-white">Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
