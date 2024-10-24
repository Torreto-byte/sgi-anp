@extends('layouts.master')

@section('title', 'Accueil')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                <div class="page_title_left d-flex align-items-center">
                    <h3 class="f_s_25 f_w_700 dark_text mr_30">Tableau de bord</h3>
                </div>
                <div class="page_title_right">
                    <div class="page_date_button d-flex align-items-center">
                        <img src="img/icon/calender_icon.svg" alt>
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
                                    <img src="img/crm/businessman.svg" alt>
                                </div>
                                <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                            </div>
                            <div class="crm_body">
                                <h4>5</h4>
                                <p>Courriés arrivés du jour</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single_crm ">
                            <div class="crm_head crm_bg_1 d-flex align-items-center justify-content-between">
                                <div class="thumb">
                                    <img src="img/crm/customer.svg" alt>
                                </div>
                                <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                            </div>
                            <div class="crm_body">
                                <h4>2</h4>
                                <p>En attente d'imputation</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single_crm">
                            <div class="crm_head crm_bg_2 d-flex align-items-center justify-content-between">
                                <div class="thumb">
                                    <img src="img/crm/infographic.svg" alt>
                                </div>
                                <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                            </div>
                            <div class="crm_body">
                                <h4>0</h4>
                                <p>En attente de traitement</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="single_crm">
                            <div class="crm_head crm_bg_3 d-flex align-items-center justify-content-between">
                                <div class="thumb">
                                    <img src="img/crm/sqr.svg" alt>
                                </div>
                                <i class="fas fa-ellipsis-h f_s_11 white_text"></i>
                            </div>
                            <div class="crm_body">
                                <h4>0</h4>
                                <p>Utilisateurs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
