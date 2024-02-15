@extends('layouts.apps')

@section('content')
<div class="container-fluid">
    <div class="card card-custom shadow mb-4 mt-5">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h4 class="h4">Jumlah Tenaga Ahli Per Jenjang</h4>
            </div>
        </div>
        <div class="card-body">
          <div class="table">
            <table class="table table-bordered" id="skpk" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle text-center">Tahun Terbit SKK/Jenjang</th>
                        <th colspan="4" class="align-middle text-center">Nilai SKPK</th>
                    </tr>
                    <tr>
                        <th class="text-center">0 -100</th>
                        <th class="text-center">101 - 150</th>
                        <th class="text-center">151 - 200</th>
                        <th class="text-center"> >200</th>
                    </tr>
                </thead>
                <tbody class="text-center font-weight-bold">
                    @foreach ($resultArray as $item)
                    <tr>
                        <td>{{$item}}</td>
                        <td>2021</td>
                        <td>2021</td>
                        <td>2021</td>
                        <td>2021</td>
                    </tr>
                    @endforeach
                  
                    <tr>
                        <td>Jenjang 7</td>
                        <td>Jenjang 7</td>
                        <td>Jenjang 7</td>
                        <td>Jenjang 7</td>
                        <td>Jenjang 7</td>
                    </tr>
                    <tr> 
                        <td>Jenjang 7</td>
                    </tr>
                    <tr>
                        <td>Jenjang 7</td></tr>
                </tbody>
            </table>  
          </div>
        </div>
      </div>
   
    
</div>
@endsection
