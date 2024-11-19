@extends('layouts.master_courrier')

@section('title', 'Accueil')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                <div class="page_title_left align-items-center">
                    <h3 class="f_s_25 f_w_700 dark_text mb-4 mr_30">Tableau de bord</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item d-flex">
                            <h6 class="mt-2 me-3">Bienvenue </h6><h3 class="text-danger">{{ Auth::user()->full_name }}</h3><h5 class="mt-1 ms-2"> --- {{ session()->get('role') }}</h5>
                        </li>
                    </ol>
                </div>
                <div class="page_title_right">
                    <div class="page_date_button d-flex align-items-center">
                        <img src="{{ asset('img/icon/calender_icon.svg') }}" alt>
                        {{ date('d-m-Y') }}
                    </div>
                </div>
            </div>
        </div>

        @if (session()->get('role_id') == 2 || session()->get('role_id') == 3)

            <div class="col-12">
                <div class="white_card card_height_100 mb_30 user_crm_wrapper">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="single_crm">
                                <div class="crm_head d-flex align-items-center justify-content-between">
                                    <div class="thumb">
                                        <i class="ti-import" style="font-size: 20px"></i>
                                    </div>
                                    <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                                </div>
                                <div class="crm_body">
                                    <h2>{{ $nbrLetterIns->count() }}</h2>
                                    <p class="text-dark"><h5>Courriés arrivés du jour</h5></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="single_crm ">
                                <div class="crm_head crm_bg_1 d-flex align-items-center justify-content-between">
                                    <div class="thumb">
                                        <i class="ti-location-arrow" style="font-size: 20px"></i>
                                    </div>
                                    <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                                </div>
                                <div class="crm_body">
                                    <h2>{{ $nbrLetterNotImput->count() }}</h2>
                                    <p class="text-dark"><h5>En attente d'imputation</h5></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="single_crm">
                                <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                                    <div class="thumb">
                                        <i class="ti-write" style="font-size: 20px"></i>
                                    </div>
                                    <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                                </div>
                                <div class="crm_body">
                                    <h2>{{ $nbrLetterNotDecharg->count() }}</h2>
                                    <p class="text-dark"><h5>En attente de décharge</h5></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="single_crm">
                                <div class="crm_head crm_bg_3 d-flex align-items-center justify-content-between">
                                    <div class="thumb">
                                        <i class="ti-email" style="font-size: 20px"></i>
                                    </div>
                                    <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                                </div>
                                <div class="crm_body">
                                    <h2>{{ $nbrLetterNotRep->count() }}</h2>
                                    <p class="text-dark"><h5>En attente de reponse</h5></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="white_card card_height_100 min_height_oveflow mb_20 ">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="page_title_left">
                                <h3 class="f_s_25 f_w_700 m-0">Liste des courriers arrivés</h3>
                            </div>
                            @if (session()->get('role_id') == 2)
                                <div class="header_more_tool">
                                    <a href="{{ route('courrier-arrive.create') }}" class="btn btn-outline-danger rounded-pill">Enregistrer un nouveau courrier</a>
                                </div>
                            @endif
                        </div>
                    </div><br><br>
                    <div class="white_card_body QA_section">
                        <div class="QA_table ">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
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

            <div class="col-md-3">
                <div class="white_card card_height_100 min_height_oveflow mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Activités récentes</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="Activity_timeline">
                            <ul>
                                @foreach ($getActivity as $item)
                                    <li>
                                        <div class="activity_bell bell_lite"></div>
                                        <div class="timeLine_inner d-flex align-items-center">
                                            <div class="activity_wrap">
                                                <h6>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</h6>
                                                <p>{{ $item->operations }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        @endif


        @if (session()->get('role_id') == 4)

            <div class="col-12">
                <div class="white_card card_height_100 mb_30 user_crm_wrapper">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="single_crm ">
                                <div class="crm_head crm_bg_1 d-flex align-items-center justify-content-between">
                                    <div class="thumb">
                                        <img src="{{ asset('img/crm/customer.svg') }}" alt>
                                    </div>
                                    <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                                </div>
                                <div class="crm_body">
                                    <h2>{{ $nbrLetterOutDay->count() }}</h2>
                                    <p class="text-dark"><h5>Courriés départ du jour</h5></p>
                                </div>
                            </div>
                        </div>

                        @if (session()->get('agent_absent') == 1)
                            <div class="col-md-3">
                                <div class="single_crm">
                                    <div class="crm_head d-flex align-items-center justify-content-between">
                                        <div class="thumb">
                                            <i class="ti-import" style="font-size: 20px"></i>
                                        </div>
                                        <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                                    </div>
                                    <div class="crm_body">
                                        <h2>{{ $nbrLetterIns->count() }}</h2>
                                        <p class="text-dark"><h5>Courriés arrivés du jour</h5></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="white_card card_height_100 min_height_oveflow mb_20 ">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="page_title_left">
                                <h3 class="f_s_25 f_w_700 m-0">Liste des courriers départ</h3>
                            </div>
                            {{-- @if (session()->get('role_id') == 2) --}}
                            <div class="header_more_tool">
                                <a href="{{ route('courrier-depart.create') }}" class="btn btn-outline-danger rounded-pill">Enregistrer un nouveau courrier</a>
                            </div>
                            {{-- @endif --}}
                        </div>
                    </div><br><br>
                    <div class="white_card_body QA_section">
                        <div class="QA_table ">

                            <table class="table" id="order-listing">
                                <thead>
                                    <tr>
                                        <th class="fw-bold" scope="col">CHRONO</th>
                                        <th class="fw-bold" scope="col">DATE DEPART</th>
                                        <th class="fw-bold" scope="col">NUMERO</th>
                                        <th class="fw-bold" scope="col">DESTINATAIRE</th>
                                        <th class="fw-bold" scope="col">STATUT</th>
                                        <th class="fw-bold" scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($itemsOut->count() > 0)

                                        @foreach ( $itemsOut as $item )
                                            <tr>
                                                <td class="text-danger">N° {{ $item->numero }} </td>
                                                <td class="fw-bold">{{ date('d-m-Y', strtotime($item->date_send)) }}</td>
                                                <td>{{ $item->number }}</td>
                                                <td>{{$item->sender }} </td>
                                                @if($item->etat == null)
                                                    <td><span class="badge rounded-pill bg-warning">Non classé</span></td>
                                                @endif
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('courrier-depart.show', $item->id) }}" type="button" class="btn btn-outline-info rounded-pill mb-3 me-2 f_s_13">
                                                            <i class="ti-eye f_s_16 me-2"></i>Voir
                                                        </a>

                                                        <a href="{{ route('courrier-depart.edit', $item->id) }}" type="button" class="btn btn-outline-primary rounded-pill mb-3 me-2 f_s_13">
                                                            <i class="ti-pencil-alt f_s_14 me-2"></i>Modifier
                                                        </a>

                                                        <button type="submit" class="btn btn-outline-danger rounded-pill mb-3 f_s_13" data-bs-toggle="modal" data-bs-target="#exampleModalClasser{{ $item->id }}">
                                                            <i class="ti-close f_s_14 me-2"></i>Classer
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    @else
                                        <tr><td colspan="5"><strong><h4 class="text-center" style="color: red"> Aucun courrier en attente !</h4></strong></td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="white_card card_height_100 min_height_oveflow mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Activités récentes</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="Activity_timeline">
                            <ul>
                                @foreach ($getActivity as $item)
                                    <li>
                                        <div class="activity_bell bell_lite"></div>
                                        <div class="timeLine_inner d-flex align-items-center">
                                            <div class="activity_wrap">
                                                <h6>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</h6>
                                                <p>{{ $item->operations }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        @endif
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
                    <a href="{{ route('classerDepartAgent', $item->id) }}" type="button" class="btn btn-danger f_s_26 fw-bold">Classer</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
