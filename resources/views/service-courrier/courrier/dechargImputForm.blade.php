@extends('layouts.master_courrier')

@section("title", "Modification d'une imputation")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers arrivés</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item">
                            <h6 class="m-0">Modification d'une imputation - courrier <strong class="text-red-600"> {{ $singleData->numero }} </strong> </h6>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('agentSaveDechargeImputation', $singleData->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-4">
                <div class="white_card">
                    <div class="white_card_header border_bottom_1px"><h4 class="card-title mb-0">Courrier PDF</h4></div>
                    <div class="card-body">
                        <div class="white_card card_height_100 mb_30">
							<div class="white_card_body">
								@if (Storage::disk('public')->exists($singleData->files))
                                    <iframe src="{{ asset('storage/'.$singleData->files) }}" width="100%" height="600">
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

                    <input type="text" name="courrierID" value="{{ $singleData->id }}" hidden />

                    <input type="text" name="code" value="{{ $singleData->code_instruction }}" hidden />

                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Numéro</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="numero" value="{{ $singleData->numero }}" class="form-control text-danger" readonly/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Expéditeur</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="expediteur" value="{{ $singleData->expeditor }}" class="form-control" readonly/>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-4">
                <div class="white_card">
                    <div class="white_card_header border_bottom_1px"><h4 class="card-title mb-0">Imputation</h4></div>

                    <div class="card-body">
                        <div class="accordion mb-5" id="accordionExample">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label class="fw-bold form-label col-xl-3 col-lg-3 col-form-label">Date de réception</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input type="date" name="date_reception" class="form-control @error('date_reception') is-invalid @enderror"/>
                                        @error('date_reception')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="fw-bold form-label col-xl-3 col-lg-3 col-form-label">Nom de l'agent</label>
                                    <div class="col-lg-9 col-xl-8">
                                        <input type="text" name="nom_agent" class="form-control @error('date_reception') is-invalid @enderror" onChange="javascript:this.value=this.value.toUpperCase()"/>
                                        @error('nom_agent')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="d-flex">
                            <a href="{{ route('courrierHomePage') }}" class="btn_2 mt-1 mb-1 w-40 me-5">Annuler</a>
                            <button type="submit" class="btn_1 mt-1 mb-1 w-40">Ajouter la décharge</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </form>

@endsection
