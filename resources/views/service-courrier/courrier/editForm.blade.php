@extends('layouts.master_courrier')

@section("title", "Modification d'un courrier arrivé")

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page_title_box d-flex align-items-center justify-content-between">
                <div class="page_title_left">
                    <h3 class="f_s_30 f_w_700 dark_text">Gestion des courriers arrivés</h3>
                    <ol class="breadcrumb page_bradcam mb-0">
                        <li class="breadcrumb-item">
                            <h6 class="m-0 text-red-600">Modification d'un courrier arrivé</h6>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('courrier-arrive.update', $singleData->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-lg-6">
                <div class="white_card">
                    <div class="white_card_header border_bottom_1px"><h4 class="card-title mb-0">Joindre le courrier scanné en PDF</h4></div>
                    <div class="card-body">
                        <div class="white_card card_height_100 mb_30">
							<div class="white_card_body">
								<h6 class="card-subtitle mb-2">Autorisé <code>type="Pdf"</code></h6>
								<div class=" mb-0">
									<input type="file" name="fichier" id="file" class="@error('fichier') is-invalid @enderror" accept=".pdf">
                                    {{-- <p>{{ $singleData->files }}</p> --}}
                                    @error('fichier')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
								</div>
							</div>
                            <!-- Zone d'affichage du fichier téléchargé -->
                            <div id="file-preview" class="mt-3"></div>
						</div>
                    </div>

                </div>

            </div>

            <div class="col-lg-6">
                <div class="white_card">
                    <div class="white_card_header border_bottom_1px"><h4 class="card-title mb-0">Indexation du courrier</h4></div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Numéro</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="numero" value="{{ $singleData->numero }}" class="form-control @error('numero') is-invalid @enderror"/>
                                @error('numero')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Date d'arrivée</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="date" name="date" value="{{ \Carbon\Carbon::parse($singleData->date_add)->format('Y-m-d') }}" class="form-control @error('date') is-invalid @enderror"/>
                                @error('date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Date & numéro de correspondance <i class="text-danger">(Facultatif)</i></label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="date_correspond" value="{{ $singleData->date_number_correspond }}" class="form-control @error('date_correspond') is-invalid @enderror" />
                                @error('date_correspond')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Expéditeur</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="expediteur" value="{{ $singleData->expeditor }}" class="form-control @error('expediteur') is-invalid @enderror" onChange="javascript:this.value=this.value.toUpperCase()"/>
                                @error('expediteur')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="form-label col-xl-3 col-lg-3 col-form-label">Objet</label>
                            <div class="col-lg-9 col-xl-8">
                                <input type="text" name="objet" value="{{ $singleData->object }}" class="form-control @error('objet') is-invalid @enderror"/>
                                @error('objet')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="fw-bold text-red-600 form-label col-xl-3 col-lg-3 col-form-label">Chrono</label>
                            <div class="col-lg-9 col-xl-8">
                                <select name="chrono" class="form-control @error('chrono') is-invalid @enderror">
                                    <option value="{{ $singleData->chrono_id }}">{{ $singleData->number }}</option>
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
                            <a href="{{ route('courrierHomePage') }}" class="btn_2 mt-1 mb-1 w-40 me-5">Annuler</a>
                            <button type="submit" class="btn_1 mt-1 mb-1 w-40">Modifier</button>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </form>

    <script>
        document.getElementById('file').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('file-preview');
            preview.innerHTML = ''; // Réinitialise l'aperçu

            if (file) {
                const fileType = file.type;
                const fileURL = URL.createObjectURL(file);

                // Vérifier si le fichier est un PDF
                if (fileType === 'application/pdf') {
                    const iframe = document.createElement('iframe');
                    iframe.src = fileURL;
                    iframe.width = '100%';
                    iframe.height = '600px';
                    preview.appendChild(iframe);
                }else {
                    preview.innerHTML = '<p>Format de fichier non pris en charge.</p>';
                }
            }
        });
    </script>

@endsection
