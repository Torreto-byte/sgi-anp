@extends('layouts.master')

@section("title", "Courrier arrivé")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers arrivés</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item">
                            <h6 class="m-0 text-red-600">Information du courrier arrivé </h6>
                        </li>
                    </ol>
                </div>
                <a href="{{ route('archiveArrive') }}" class="btn rounded-pill btn-info mt-1 mb-1 w-40 me-5">Retour</a>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="white_card">
                <div class="white_card_header border_bottom_1px d-flex">
                    <h4 class="card-title mb-0 me-auto">Courrier Pdf</h4>
                    <a target="_blank" href="{{ asset('storage/'.$item->files) }}" type="button" class="btn rounded-pill btn-warning text-white">
                        <i class="ti-printer f_s_14 me-2"></i>Imprimer le courrier
                    </a>
                </div>
                <div class="card-body">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_body">
                            @if (Storage::disk('public')->exists($item->files))
                                <iframe src="{{ asset('storage/'.$item->files) }}" width="100%" height="600">
                                </iframe>
                            @else
                                <strong><h5 class="f_s_18 f_w_600 text-center"><i class="ti-alert me-2 text-danger" style="font-size: 150%"></i>Document introuvable !</h5></strong>
                            @endif

                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-md-4">
            <div class="white_card">
                <div class="white_card_header border_bottom_1px"><h4 class="card-title mb-0">Information sur le courrier</h4></div>

                <div class="card-body">
                    <div class="table-responsive shopping-cart">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Chrono :</p>
                                    </td>
                                    <td><h4 class="f_w_800 text-danger">{{ $item->numero }}</h4></td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Date d'arrivée :</p>
                                    </td>
                                    <td><h4 class="f_w_600 text-primary">{{ date('d-m-Y', strtotime($item->date_add)) }}</h4></td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Numéro :</p>
                                    </td>
                                    <td><h4 class="f_w_800 text-dark">{{ $item->number }}</h4></td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Expéditeur :</p>
                                    </td>
                                    <td><h4 class="f_w_800 text-dark">{{ $item->expeditor }}</h4></td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Objet :</p>
                                    </td>
                                    <td><h4 class="f_w_600 text-dark">{{ $item->object }}</h4></td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Pièce jointe :</p>
                                    </td>
                                    <td><h4 class="f_w_600 text-dark">{{ $item->attachment }}</h4></td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Courrier enregistré le :</p>
                                    </td>
                                    <td>
                                        <h4 class="f_w_600 text-primary">{{ date('d-m-Y à H:i', strtotime($item->created_at)) }}</h4>
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Par l'agent :</p>
                                    </td>
                                    <td><h4 class="f_w_600 text-dark">{{ $item->full_name }}</h4></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="white_card">
                <div class="white_card_header border_bottom_1px"><h4 class="card-title mb-0">Imputation</h4></div>

                <div class="card-body">
                    @if (!is_null($itemImput))
                        <div class="table-responsive shopping-cart">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Direction :</p>
                                        </td>
                                        <td><h3 class="f_s_30 f_w_800 text-danger">{{ $itemImput->sigle }}</h3></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Date de réception :</p>
                                        </td>
                                        <td>
                                            @if ($itemImput->date_reception == null)
                                                <span class="badge rounded-pill bg-danger">En attente !</span>
                                            @else
                                                <h5 class="f_s_16 f_w_600 text-primary">{{ date('d-m-Y', strtotime($itemImput->date_reception)) }}</h5>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Réçu Par :</p>
                                        </td>
                                        <td>
                                            @if ($itemImput->name_agent == null)
                                                <span class="badge rounded-pill bg-dark">Non réceptionné</span>
                                            @else
                                                <h5 class="f_s_16 f_w_600 text-dark">{{ $itemImput->name_agent }}</h5>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <p class="d-inline-block align-middle mb-0 product-name f_s_16 f_w_600 color_theme2">Instruction :</p>
                                        </td>
                                        <td>
                                            @if ($item->code_instruction == null)
                                                <span class="badge rounded-pill bg-warning">Non défini</span>
                                            @else
                                                <span class="f_s_20 fw_bold text-white badge rounded-pill bg-danger" style="color: red">{{ $item->code_instruction }}</span>
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    @else
                        <strong><h5 class="f_s_16 f_w_600 text-center text-danger">En attente !</h5></strong>
                    @endif
                </div>

            </div>

        </div>
    </div>


@endsection
