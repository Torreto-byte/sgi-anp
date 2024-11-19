@extends('layouts.master')

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

        <div class="col-12">
            <div class="white_card card_height_100 mb_30 user_crm_wrapper">
                <div class="row">
                    <div class="col-md-3">
                        <div class="single_crm">
                            <div class="crm_head d-flex align-items-center justify-content-between">
                                <div class="thumb">
                                    <i class="ti-import" style="font-size: 20px"></i>
                                </div>
                            </div>
                            <div class="crm_body">
                                <h4>{{ $nbrLetterIns->count() }}</h4>
                                <p>Courriés arrivés</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single_crm ">
                            <div class="crm_head crm_bg_1 d-flex align-items-center justify-content-between">
                                <div class="thumb">
                                    <i class="ti-location-arrow" style="font-size: 20px"></i>
                                </div>
                            </div>
                            <div class="crm_body">
                                <h4>{{ $nbrLetterNotImput->count() }}</h4>
                                <p>En attente d'imputation</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single_crm">
                            <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                                <div class="thumb">
                                    <i class="ti-email" style="font-size: 20px"></i>
                                </div>
                            </div>
                            <div class="crm_body">
                                <h4>{{ $nbrLetterNotRep->count() }}</h4>
                                <p>En attente de reponse</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single_crm">
                            <div class="crm_head crm_bg_3 d-flex align-items-center justify-content-between">
                                <div class="thumb">
                                    <i class="ti-user" style="font-size: 20px"></i>
                                </div>
                            </div>
                            <div class="crm_body">
                                <h4>{{ $nbreUser->count() }}</h4>
                                <p>Utilisateurs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="white_card card_height_100 mb_20 ">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="page_title_left">
                            <h3 class="f_s_25 f_w_700 m-0">Liste des courriers en attente d'imputation</h3>
                        </div>
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
                                            <td class="fw-bold text-danger">{{ date('d-m-Y', strtotime($item->date_add)) }}</td>
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
                                                            <a href="{{ route('courriers-arrives.show', $item->id) }}" type="button" class="dropdown-item mt-2 mb-3 me-2 f_s_26 fw-bold">
                                                                <i class="ti-eye f_s_16 me-2"></i>Voir les détails
                                                            </a>

                                                            {{-- @if (session()->get('role_id') == 2) --}}
                                                                <a href="{{ route('courriers-arrives.edit', $item->id) }}" type="button" class="dropdown-item mb-3 me-2 f_s_26 fw-bold">
                                                                    <i class="ti-pencil-alt f_s_14 me-2"></i>Modifier
                                                                </a>
                                                            {{-- @endif --}}

                                                            {{-- @if ($item->etat == null)
                                                                <button type="submit" class="dropdown-item mb-3 me-2 f_s_26 fw-bold text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalClasser{{ $item->id }}">
                                                                    <i class="ti-close f_s_14 me-2"></i>Classer
                                                                </button>
                                                            @endif --}}

                                                        </div>
                                                    </div>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-secondary rounded-pill mb-3 me-2 f_s_13 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-location-arrow f_s_16 me-2"></i> Imputation
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @if ($item->code_instruction == null)
                                                                <a class="dropdown-item mt-2 mb-2 f_s_26 fw-bold" href="{{ route('imputation', $item->id) }}">Attribution</a>
                                                            @endif
                                                            @if ($item->code_instruction != null)
                                                                @if ($item->etat == null)
                                                                    <a class="dropdown-item mt-2 mb-2 f_s_26 fw-bold" href="{{ route('editImputation', $item->id) }}">Modifier</a>
                                                                    {{-- @if (session()->get('role_id') == 2) --}}
                                                                        <a class="dropdown-item mt-2 mb-2 f_s_26 fw-bold" href="{{ route('dechargeImputation', $item->id) }}">Décharger</a>
                                                                    {{-- @endif --}}
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr><td colspan="5"><strong><h4 class="text-center" style="color: red"> Aucun courrier en attente d'imputation !</h4></strong></td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
