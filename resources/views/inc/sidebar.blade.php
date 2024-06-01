<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">

            <li class="nav-label first">Ana Sayfa</li>
            <li><a href="{{route('dashboard')}}" aria-expanded="false"><i class="icon icon-layout-25"></i><span
                        class="nav-text">{{"Panel"}}</span></a></li>

            <li class="nav-label">İşlemler</li>
            <li><a href="{{route('medical-waste.index')}}" aria-expanded="false"><i class="icon-trash icons"></i><span
                        class="nav-text">Tıbbi Atık</span></a></li>
            @role('manager|authorized officer')
            <li><a href="{{route('report.index')}}" aria-expanded="false"><i class="icon-layers icons"></i><span
                        class="nav-text">Rapor</span></a></li>
            @endrole
            @role('manager')
            <li class="nav-label">Kullanıcılar</li>
            {{--            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i--}}
            {{--                        class="icon icon-world-2"></i><span class="nav-text">Bootstrap</span></a>--}}
            {{--                <ul aria-expanded="false">--}}
            {{--                    <li><a href="./ui-accordion.html">Accordion</a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}

            <li><a href="{{route('doctor.index')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Doktor</span></a></li>
            <li><a href="{{route('nurse.index')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Hemşire</span></a></li>
            <li><a href="{{route('manager.index')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Yönetici</span></a></li>
            <li><a href="{{route('authorized-officer.index')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Yetkili Memur</span></a></li>
            <li><a href="{{route('waste-collection-staff.index')}}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Atık Toplama Personeli</span></a></li>
            @endrole
        </ul>
    </div>
</div>
