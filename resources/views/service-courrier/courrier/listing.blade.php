@extends('layouts.master_courrier')

@section('title', 'Liste des courriers arrivés')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers arrivés</h3>
                </div>
                @if (session()->get('role_id') == 2)
                    <a href="{{ route('courrier-arrive.create') }}" class="white_btn3">Enregistrer un nouveau courrier</a>
                @endif
                @if (session()->get('role_id') == 4 && session()->get('agent_absent') == 1)
                    <a href="{{ route('courrier-arrive.create') }}" class="white_btn3">Enregistrer un nouveau courrier</a>
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30 pt-4">
                <div class="white_card_body">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Liste des courriers arrivés</h4>
                            {{-- <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form Active="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Rechercher dans cette liste">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="add_button ms-2">
                                    <a href="#" data-toggle="modal" data-target="#addcategory" class="btn_1">rechercher</a>
                                </div>
                            </div> --}}
                        </div>
                        <div class="QA_table mb_30">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th class="fw-bold" scope="col">CHRONO</th>
                                        <th class="fw-bold" scope="col">DATE D'ARRIVEE</th>
                                        <th class="fw-bold" scope="col">NUMERO</th>
                                        <th class="fw-bold" scope="col">EXPEDITEUR</th>
                                        <th class="fw-bold" scope="col">INSTRUCTION</th>
                                        <th class="fw-bold" scope="col">IMPUTATION</th>
                                        <th class="fw-bold" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($items->count() > 0)

                                        @foreach ( $items as $item )
                                            <tr>
                                                <td class="text-danger">N° {{ $item->numero }} </td>
                                                <td class="fw-bold">{{ date('d-m-Y', strtotime($item->date_add)) }}</td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{$item->expeditor }} </td>
                                                @if ($item->code_instruction == null)
                                                    <td><span class="badge rounded-pill bg-success">en attente</span></td>
                                                @elseif($item->code_instruction == 'classer')
                                                    <td><span class="badge rounded-pill bg-danger">classer</span></td>
                                                @else
                                                    <td><span class="badge rounded-pill bg-warning">{{ $item->code_instruction }}</span></td>
                                                @endif
                                                @if($item->code_instruction == null)
                                                    <td><span class="badge rounded-pill bg-dark">en attente</span></td>
                                                @else
                                                    <td>{{$item->sigle }} </td>
                                                @endif
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-outline-primary rounded-pill mb-3 me-2 f_s_13 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ti-more f_s_16 me-2"></i> ACTIONS
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a href="{{ route('courrier-arrive.show', $item->id) }}" type="button" class="dropdown-item mt-2 mb-3 me-2 f_s_26 fw-bold">
                                                                    <i class="ti-eye f_s_16 me-2"></i>Voir les détails
                                                                </a>

                                                                @if (session()->get('role_id') == 2)
                                                                    <a href="{{ route('courrier-arrive.edit', $item->id) }}" type="button" class="dropdown-item mb-3 me-2 f_s_26 fw-bold">
                                                                        <i class="ti-pencil-alt f_s_14 me-2"></i>Modifier
                                                                    </a>
                                                                @endif

                                                                @if ($item->etat == null)
                                                                    <button type="submit" class="dropdown-item mb-3 me-2 f_s_26 fw-bold text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalClasser{{ $item->id }}">
                                                                        <i class="ti-close f_s_14 me-2"></i>Classer
                                                                    </button>
                                                                @endif

                                                            </div>
                                                        </div>

                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-outline-secondary rounded-pill mb-3 me-2 f_s_13 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ti-location-arrow f_s_16 me-2"></i> Imputation
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @if ($item->code_instruction == null)
                                                                    <a class="dropdown-item mt-2 mb-2 f_s_26 fw-bold" href="{{ route('agentImputation', $item->id) }}">Attribution</a>
                                                                @endif
                                                                @if ($item->code_instruction != null)
                                                                    @if ($item->etat == null)
                                                                        <a class="dropdown-item mt-2 mb-2 f_s_26 fw-bold" href="{{ route('agentEditImputation', $item->id) }}">Modifier</a>
                                                                        @if (session()->get('role_id') == 2)
                                                                            <a class="dropdown-item mt-2 mb-2 f_s_26 fw-bold" href="{{ route('agentDechargeImputation', $item->id) }}">Décharger</a>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
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
                    <a href="{{ route('agentClasser', $item->id) }}" type="button" class="btn btn-danger f_s_26 fw-bold">Classer</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
