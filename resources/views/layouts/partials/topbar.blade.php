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
                            <a class="bell_notification_clicker" href="#"> <img src="{{asset('img/icon/bell.svg')}}" alt>
                                <span>{{ auth()->user()->unreadNotifications->count() }}</span>
                            </a>

                            <div class="Menu_NOtification_Wrap">
                                <div class="notification_Header">
                                    <h4>Notifications</h4>
                                </div>
                                <div class="Notification_body">

                                    @forelse (auth()->user()->unreadNotifications as $notification)

                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="{{ $notification->data['titre'] }}"><img src="{{ asset('img/staf/notification.png') }}" alt></a>
                                            </div>
                                            <div class="notify_content">
                                                <a href="{{ $notification->data['titre'] }}">
                                                    <h5>{{ $notification->data['titre'] }}</h5>
                                                </a>
                                                <p>{{ $notification->data['message'] }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="fw-bold text-md-center">Pas de notification</p>
                                    @endforelse
                                </div>
                                <div class="nofity_footer">
                                    <div class="submit_button text-center pt_20">
                                        <a href="#" class="btn_1">Voir plus</a>
                                    </div>
                                </div>
                            </div>

                        </li>
                    </div>
                    <div class="profile_info">
                        <img src="{{ asset('img/avatar.png') }}" alt="#">
                        <div class="profile_info_iner">
                            <div class="profile_author_name">
                                <p>{{ session()->get('role'); }}</p>
                                <h5>{{ Auth::user()->full_name }}</h5>
                            </div>
                            <div class="profile_info_details">
                                <a href="#">My Profile </a>
                                <a href="#">Settings</a>
                                <a href="{{ route('deconnexion') }}">Se déconnecter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
