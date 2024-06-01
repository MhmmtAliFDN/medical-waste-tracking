@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
            <div class="card mb-3">
                <img class="card-img-top img-fluid" src="{{asset('assets/images/profile/emrebaranarca.jpg')}}"
                     alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">EMRE BARAN ARCA</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-dark">Web Site: <a href="http://emrebaranarca.com" target="_blank">emrebaranarca.com</a>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="https://github.com/emrebaranarca" target="_blank" class="card-link float-left"><i
                            class="icon-social-github icons"></i> Github</a>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
            <div class="card mb-3">
                <img class="card-img-top img-fluid" src="{{asset('assets/images/profile/muhammetalifidan.jpg')}}"
                     alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">MUHAMMET ALİ FİDAN</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-dark">Web Site: <a href="https://www.muhammetalifidan.com.tr"
                                                                target="_blank">muhammetalifidan.com.tr</a>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="https://github.com/mhmmtalifdn" target="_blank"  class="card-link float-left"><i
                            class="icon-social-github icons"></i> Github</a>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
            <div class="card mb-3">
                <img class="card-img-top img-fluid" src="{{asset('assets/images/profile/ahmetyildirim.jpg')}}"
                     alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">AHMET YILDIRIM</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-dark">Web Site: <a href="http://yldrmahmet.com" target="_blank">yldrmahmet.com</a>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="http://www.github.com/yldrmahmet" target="_blank" class="card-link float-left"><i
                            class="icon-social-github icons"></i> Github</a>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-xxl-6 col-lg-6 col-sm-6">
            <div class="card mb-3">
                <img class="card-img-top img-fluid" src="{{asset('assets/images/profile/mehmettagil.jpg')}}"
                     alt="Card image cap">
                <div class="card-header">
                    <h5 class="card-title">MEHMET TAĞIL</h5>
                </div>
                <div class="card-body">
                    <p class="card-text text-dark">Web Site: <a href="https://www.mehmettagil.com"
                                                                target="_blank">mehmettagil.com</a>
                    </p>
                </div>
                <div class="card-footer">
                    <a href="https://github.com/mehmettagil" target="_blank"  class="card-link float-left"><i
                            class="icon-social-github icons"></i> Github</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('customCss')
    <style>
        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }
    </style>
@endpush
