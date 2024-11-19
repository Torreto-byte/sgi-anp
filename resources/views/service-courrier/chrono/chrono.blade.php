@extends('layouts.master_courrier')

@section('title', 'Liste des chronos arrivés')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers arrivés</h3>
                </div>
                <a href="{{ route('chrono-arrive.create') }}" class="white_btn3">Ouvrir un chrono</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30 pt-4">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Liste des chronos</h4>
                        </div>
                        <div class="QA_table mb_30">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th scope="col">NUMERO</th>
                                        <th scope="col">DEBUT</th>
                                        <th scope="col">FIN</th>
                                        <th scope="col">STATUT</th>
                                        <th scope="col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($items->count() > 0)

                                        @foreach ( $items as $item )
                                            <tr>
                                                <td class="text-danger" style="font-size: 155%">N°{{ $item->numero }}</td>
                                                <td>{{ $item->num_debut }}</td>
                                                @if ($item->num_fin == null)
                                                    <td><a href="#" class="status_btn bg-dark">Non défini</a></td>
                                                @else
                                                    <td>{{ $item->num_fin }}</td>
                                                @endif
                                                @if ($item->statut == 1)
                                                    <td><a href="#" class="status_btn">OUVERT</a></td>
                                                @else
                                                    <td><a href="#" class="status_btn bg-danger">FERMER</a></td>
                                                @endif
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        @if ($item->num_fin == null)
                                                            <a href="{{ route('chrono-arrive.edit', $item->id) }}" class="btn btn-danger rounded-pill mb-3 f_s_13 me-3" title="FERMER LE CHRONO" style="padding-top: 8px;">
                                                                <i class="ti-lock f_s_14 me-2"></i> Fermer
                                                            </a>
                                                        @endif

                                                        {{-- <button type="submit" title="SUPPRIMER" class="btn btn-outline-danger rounded-pill mb-3 f_s_13" data-bs-toggle="modal" data-bs-target="#exampleModalLong{{ $item->id }}">
                                                            <i class="ti-trash f_s_14 me-2"></i>Supprimer
                                                        </button> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @else
                                        <tr><td colspan="5"><strong><h4 class="text-center" style="color: red"> Aucun chrono ouvert !</h4></strong></td></tr>
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
                    <form method="POST" action="{{ route('chrono-arrive.destroy', $item->id) }} ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-info text-white">Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
