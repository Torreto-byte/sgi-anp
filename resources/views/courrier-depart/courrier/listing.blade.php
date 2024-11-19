@extends('layouts.master')

@section('title', 'Liste des courriers départs')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers départs</h3>
                </div>
                <a href="{{ route('courriers-departs.create') }}" class="white_btn3">Enregistrer un nouveau courrier</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30 pt-4">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Liste des courriers départs</h4>
                        </div>
                        <div class="QA_table mb_30">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th class="fw-bold" scope="col">CHRONO</th>
                                        <th class="fw-bold" scope="col">DATE DEPART</th>
                                        <th class="fw-bold" scope="col">NUMERO</th>
                                        <th class="fw-bold" scope="col">DESTINATAIRE</th>
                                        <th class="fw-bold" scope="col">OBJECT</th>
                                        <th class="fw-bold" scope="col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($items->count() > 0)

                                        @foreach ( $items as $item )
                                            <tr>
                                                <td class="text-danger">N° {{ $item->numero }} </td>
                                                <td class="fw-bold">{{ date('d-m-Y', strtotime($item->date_send)) }}</td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{$item->sender }} </td>
                                                <td>{{$item->object }} </td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('courriers-departs.show', $item->id) }}" type="button" class="btn btn-outline-info rounded-pill mb-3 me-2 f_s_13">
                                                            <i class="ti-eye f_s_16 me-2"></i>Voir
                                                        </a>

                                                        <a href="{{ route('courriers-departs.edit', $item->id) }}" type="button" class="btn btn-outline-primary rounded-pill mb-3 me-2 f_s_13">
                                                            <i class="ti-pencil-alt f_s_14 me-2"></i>Modifier
                                                        </a>

                                                        <button type="submit" class="btn btn-outline-warning rounded-pill mb-3 f_s_13" data-bs-toggle="modal" data-bs-target="#exampleModalClasser{{ $item->id }}">
                                                            <i class="ti-trash f_s_14 me-2"></i>Classer
                                                        </button>

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
                    <form method="POST" action="{{ route('courriers-departs.destroy', $item->id) }} ">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-info text-white">Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalClasser{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalClasserTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalClasserTitle">Classification</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Voulez-vous marquer ce courrier comme <strong>classé</strong> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-5" data-bs-dismiss="modal">Annuler</button>
                    <a href="{{ route('classerDepart', $item->id) }}" type="button" class="btn btn-danger f_s_26 fw-bold">Classer</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
