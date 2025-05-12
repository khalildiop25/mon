


<!-- Mes Tontines -->
<li class="nav-item">
    <a style="color:#4c8bf5 ! important;" class="nav-link nav-colored nav-mes-tontines" href="{{ route('participant.tontines', auth()->user()->participant->id) }}">
        <i style="color:#4c8bf5;" class="fas fa-users fa-fw"></i> Mes tontines
    </a>
</li>

<!-- Cotiser -->
<li class="nav-item">
    <a style="color:#28a745 ! important;"  class="nav-link nav-colored nav-cotiser" href="{{ route('cotisations.Participant', auth()->user()->id) }}">

        <i  style="color:#28a745;" class="fas fa-credit-card fa-fw"></i> Cotiser
    </a>
</li>

<!-- Mes cotisations -->
<li class="nav-item">
    <a style="color:#d1a41e !important;"class="nav-link nav-colored nav-mes-cotisations" href="{{ route('cotisations.user', auth()->user()->id) }}">
        <i   style="color:#d1a41e;" class="fas fa-list fa-fw"></i> Mes cotisations
    </a>
</li>

<!-- Tirage -->
<li class="nav-item">
    <a style="color:#f58d42 !important;" class="nav-link nav-colored nav-tirage" href="{{ route('tirage.form', auth()->user()->id) }}">
        <i    style="color:#f58d42;" class="fas fa-cogs fa-fw"></i> Tirage
    </a>
</li>

<!-- Notifications -->
<li class="nav-item dropdown">
    <a style="color: #e03050 !important;"  class="nav-link dropdown-toggle nav-colored nav-notifications" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i  style="color: #e03050;"  class="fas fa-bell fa-fw"></i>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="badge badge-notif badge-counter">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown">
        @forelse(auth()->user()->unreadNotifications as $notification)
            <a class="dropdown-item" href="#">
                {{ $notification->data['message'] }}
            </a>
            @php $notification->markAsRead(); @endphp
        @empty
            <span class="dropdown-item text-muted">Aucune nouvelle notification</span>
        @endforelse
    </div>
</li>






