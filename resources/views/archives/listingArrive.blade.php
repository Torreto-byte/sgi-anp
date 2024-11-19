@extends('layouts.master')

@section('title', 'Liste des courriers arrivés')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Archive des courriers arrivés</h3>
                </div>
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
                                                <td>{{$item->sigle }} </td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('archiveDetailsArrive', $item->id) }}" type="button" class="btn btn-outline-danger rounded-pill mb-3 f_s_13">
                                                            <i class="ti-eye f_s_16 me-2"></i>Voir les détails
                                                        </a>
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
