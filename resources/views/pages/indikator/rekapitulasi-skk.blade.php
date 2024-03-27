@extends('layouts.apps')

@section('content')
<div class="container-fluid">
    <div class="card card-custom shadow mb-4 mt-5">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h4 class="h4">Jumlah Tenaga Ahli Per Jenjang</h4>
                <span class="badge badge-primary"> Data Updated : {{$cek->date}}</span>
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
                        <th class="text-center">1 - 49</th>
                        <th class="text-center">50 - 99</th>
                        <th class="text-center">100 - 149</th>
                        <th class="text-center">150 - 199</th>
                        <th class="text-center"> >200</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultArray as $year => $jenjangs)
                        <tr style="background-color: #EFF396;" class="align-middle text-center">
                            <td>{{ $year }}</td>
                            <td>{{$resultArray[$year]['7']['below50'] + $resultArray[$year]['8']['below50'] + $resultArray[$year]['9']['below50']}}</td>
                            <td>{{$resultArray[$year]['7']['below100'] + $resultArray[$year]['8']['below100'] + $resultArray[$year]['9']['below100']}}</td>
                            <td>{{$resultArray[$year]['7']['above100'] + $resultArray[$year]['8']['above100'] + $resultArray[$year]['9']['above100']}}</td>
                            <td>{{$resultArray[$year]['7']['above150'] + $resultArray[$year]['8']['above150'] + $resultArray[$year]['9']['above150']}}</td>
                            <td>{{$resultArray[$year]['7']['above200'] + $resultArray[$year]['8']['above200'] + $resultArray[$year]['9']['above200']}}</td>
                        </tr>
                        {{-- Jenjang 7 --}}
                        <tr class="align-middle text-center">
                            <td>Jenjang 7</td>
                            <td>{{$resultArray[$year]['7']['below50']}}</td>
                            <td>{{$resultArray[$year]['7']['below100']}}</td>
                            <td>{{$resultArray[$year]['7']['above100']}}</td>
                            <td>{{$resultArray[$year]['7']['above150']}}</td>
                            <td>{{$resultArray[$year]['7']['above200']}}</td>
                        </tr>
                        {{-- Jenjang 8 --}}
                        <tr class="align-middle text-center">
                            <td>Jenjang 8</td>
                            <td>{{$resultArray[$year]['8']['below50']}}</td>
                            <td>{{$resultArray[$year]['8']['below100']}}</td>
                            <td>{{$resultArray[$year]['8']['above100']}}</td>
                            <td>{{$resultArray[$year]['8']['above150']}}</td>
                            <td>{{$resultArray[$year]['8']['above200']}}</td>
                        </tr>
                        {{-- Jenjang 9 --}}
                        <tr class="align-middle text-center">
                            <td>Jenjang 9</td>
                            <td>{{$resultArray[$year]['9']['below50']}}</td>
                            <td>{{$resultArray[$year]['9']['below100']}}</td>
                            <td>{{$resultArray[$year]['9']['above100']}}</td>
                            <td>{{$resultArray[$year]['9']['above150']}}</td>
                            <td>{{$resultArray[$year]['9']['above200']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>  
          </div>
        </div>
      </div>
   
    
</div>
@endsection
