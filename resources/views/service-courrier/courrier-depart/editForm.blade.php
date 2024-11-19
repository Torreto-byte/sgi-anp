@extends('layouts.master_courrier')

@section("title", "Modification d'un courrier départ")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers départs</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item">
                            <h6 class="m-0 text-red-600">Modification d'un courrier départ</h6>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('courrier-depart.update', $singleData->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6">
                <div class="white_card">
                    <div class="white_card_header border_bottom_1px"><h4 class="card-title mb-0">Joindre le courrier scanné en PDF</h4></div>
                    <div class="card-body">
                        <div class="white_card card_height_100 mb_30">
							<div class="white_card_body">
								<h6 class="card-subtitle mb-2">Autorisé <code>type="Pdf"</code></h6>
								<div class=" mb-0">
									<input type="file" name="fichier" class="@error('fichier') is-invalid @enderror">
                                    @error('fichier')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
								</div>
							</div>
						</div>
                    </div>

                </div>

            </div>

            <div class="col-md-6">
                <div class="white_card">
                    <div class="white_card_header border_bottom_1px"><h4 class="card-title mb-0">Indexation du courrier</h4></div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Numéro</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="numero" value="{{ $singleData->number }}" class="form-control @error('numero') is-invalid @enderror" required/>
                                @error('numero')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Date départ</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="date" name="date" value="{{ Carbon\Carbon::parse($singleData->date_send)->format('Y-m-d') }}" class="form-control @error('date') is-invalid @enderror" required/>
                                @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Date & numéro de correspondance <i class="text-danger">(Facultatif)</i> </label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="date_correspond" value="{{ $singleData->date_number_correspond }}" class="form-control @error('date_correspond') is-invalid @enderror" />
                                @error('date_correspond')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Destinataire </label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="destinataire" value="{{ $singleData->sender }}" class="form-control @error('destinataire') is-invalid @enderror" required/>
                                @error('destinataire')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Objet</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="objet" value="{{ $singleData->object }}" class="form-control @error('objet') is-invalid @enderror" onChange="javascript:this.value=this.value.toUpperCase()" required/>
                                @error('objet')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Observation <i class="text-danger">(Facultatif)</i></label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="observation" value="{{ $singleData->observation }}" class="form-control @error('observation') is-invalid @enderror"/>
                                @error('observation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Accusé de réception <i class="text-danger">(Facultatif)</i> </label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="date" name="date_recep" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="fw-bold text-red-600 form-label col-xl-3 col-lg-3 col-form-label">Chrono</label>
                            <div class="col-lg-9 col-xl-8">
                                <select name="chrono" class="form-control @error('chrono') is-invalid @enderror" required>
                                    <option value="{{ $singleData->chrono_id}}">{{ $singleData->numero}}</option>
                                    @foreach ($getDataChrono as $data)
                                        <option value="{{ $data->id }}" class="text-danger fw-bold" style="font-size: 25px">N° {{ $data->numero }}</option>
                                    @endforeach
                                </select>
                                @error('chrono')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex">
                            <a href="{{ route('courrier-depart.index') }}" class="btn_2 mt-1 mb-1 w-40 me-5">Retour</a>
                            <button type="submit" class="btn_1 mt-1 mb-1 w-40">Modifier</button>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </form>

@endsection
