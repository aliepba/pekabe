@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4">  
        <div class="card-body">
          <ul class="nav nav-pills" id="myTab1" role="tablist">
              <li class="nav-item">
                  <a class="nav-link active" id="home-tab-1" data-toggle="tab" href="#pelaporan">
                      <span class="nav-icon">
                          <i class="flaticon2-chat-1"></i>
                      </span>
                      <span class="nav-text">Setting Pelaporan</span>
                  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="home-tab-1" data-toggle="tab" href="#soon">
                    <span class="nav-icon">
                        <i class="flaticon2-chat-1"></i>
                    </span>
                    <span class="nav-text">Setting Pelaporan</span>
                </a>
            </li>
          </ul>
        </div>
    </div>
    <div class="tab-content mt-5" id="myTabContent1">
        <div class="tab-pane fade show active" id="pelaporan" role="tabpanel" aria-labelledby="home-tab-1">
            @include('pages.system.pelaporan')
        </div>
        <div class="tab-pane fade show" id="soon" role="tabpanel" aria-labelledby="home-tab-1">
            <h4>To Be Announcement</h4>
        </div>
    </div>
</div>
@endsection
