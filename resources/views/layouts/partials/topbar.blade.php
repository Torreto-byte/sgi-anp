<style>
    .bg-light {
        background-color: #f8f9fa;
        padding-top: 13px;
        border-radius: 0px;
        padding-left: 10px;
    }

    .bg-grey {
        background-color: #fff;
        padding-top: 13px;
        border-radius: 0px;
        padding-left: 10px;
    }

    .icon-bell{
        border: 1px solid transparent;
        border-radius: 22px;
        padding: 10px;
        font-size: 25px;
        color: #f45b0f;
        background: #ffebe0
    }
</style>


<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0 ">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="line_icon open_miniSide d-none d-lg-block">
                    <img src="{{ asset('img/line_img.png') }}" alt>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">
                        <li>
                            <a class="bell_notification_clicker" id="notification" href="#"> <img src="{{asset('img/icon/bell.svg')}}" alt>
                                @if (auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge_new">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </a>

                            <div class="Menu_NOtification_Wrap">
                                <div class="notification_Header">
                                    @if (auth()->user()->unreadNotifications->count() == 1)
                                        <h4>{{ auth()->user()->unreadNotifications->count() }} Notification non lue</h4>
                                    @elseif(auth()->user()->unreadNotifications->count() > 1)
                                        <h4>{{ auth()->user()->unreadNotifications->count() }} Notifications non lues</h4>
                                    @else
                                        <h4>Pas de notification non lue</h4>
                                    @endif

                                </div>
                                <div class="Notification_body mb-4">

                                    @forelse (auth()->user()->Notifications as $notification)

                                        <div class="single_notify mb-4 d-flex align-items-start {{ $notification->read_at ? 'bg-grey' : 'bg-light' }}">
                                            <div class="notify_thumb mt-3">
                                                <i class="ti-bell me-2 icon-bell"></i>
                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5 class="text-dark">{{ $notification->data['titre'] }}</h5>
                                                </a>
                                                <p class="f_s_16">{{ $notification->data['message'] }}</p>
                                                <small class="text-danger">{{ $notification->created_at->diffForHumans() }}</small>
                                                <br>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="fw-bold text-md-center mt-5">Vous n'avez pas de notification en attente</p>
                                    @endforelse
                                </div>
                            </div>

                        </li>
                    </div>
                    <div class="profile_info">
                        <img src="{{ asset('img/avatar.png') }}" alt="#">
                        <div class="profile_info_iner">
                            <div class="profile_author_name">
                                <p>{{ session()->get('role') }}</p>
                                <h5>{{ Auth::user()->full_name }}</h5>
                            </div>
                            <div class="profile_info_details">
                                <a href="#">Mon profil</a>
                                <a href="{{ route('deconnexion') }}">Se déconnecter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('notification').addEventListener('click', function() {
        // Envoyer une requête AJAX pour marquer les notifications comme lues
        fetch("{{ route('notifications.markAsRead') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        }).then(response => {
            if (response.ok) {
                // Retirer le badge de notification une fois que les notifications sont marquées comme lues
                document.querySelector('.badge_new').style.display = 'none';
            }
        }).catch(error => {
            console.error('Erreur:', error);
        });
    });
</script>
