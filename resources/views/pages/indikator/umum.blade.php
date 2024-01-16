@extends('layouts.apps')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <span class="symbol symbol-50 symbol-light-success mr-2">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </span>
                        <div class="d-flex flex-column text-right">
                            <span class="text-dark-75 font-weight-bolder font-size-h3">{{$TotalInstansiSetuju}}</span>
                            <span class="text-muted font-weight-bold mt-2">Instansi Disetujui
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <span class="symbol symbol-50 symbol-light-success mr-2">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </span>
                        <div class="d-flex flex-column text-right">
                            <span class="text-dark-75 font-weight-bolder font-size-h3">{{$TotalkegiatanSetuju}}</span>
                            <span class="text-muted font-weight-bold mt-2">Jumlah Kegiatan Disetujui
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <span class="symbol symbol-50 symbol-light-success mr-2">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </span>
                        <div class="d-flex flex-column text-right">
                            <span class="text-dark-75 font-weight-bolder font-size-h3">{{isset($totalLain) ? $totalLain[0]->jumlah : 0}}</span>
                            <span class="text-muted font-weight-bold mt-2">Jumlah Kegiatan Disetujui Termasuk Kolaborasi
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <span class="symbol symbol-50 symbol-light-success mr-2">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </span>
                        <div class="d-flex flex-column text-right">
                            <span class="text-dark-75 font-weight-bolder font-size-h3">{{$TotalunsurSetuju}}</span>
                            <span class="text-muted font-weight-bold mt-2">Jumlah Penggunaan Unsur Disetujui
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                        <span class="symbol symbol-50 symbol-light-success mr-2">
                            <span class="symbol-label">
                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
                                            <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                        </span>
                        <div class="d-flex flex-column text-right">
                            <span class="text-dark-75 font-weight-bolder font-size-h3">{{$TotalunsurPelaporan}}</span>
                            <span class="text-muted font-weight-bold mt-2">Jumlah Penggunaan Unsur Pelaporan
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        Jumlah Akun Penyelenggara PKB berdasarkan Jenis
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body">
                    <div class="form-group">
                        <select id="chartType">
                            {{-- <option value="pie" selected>PIE CHART</option> --}}
                            <option value="bar" selected>BAR CHART</option>
                        </select>
                    </div>
                    <div id="pie" class="chart-container"></div>
                    <div id="bar" class="chart-container"></div>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        Jumlah Kegiatan Per Unsur Setujui
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body">
                    <div id="pieUnsur"></div>
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        Jumlah Kegiatan Per Unsur Pelaporan
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body">
                    <div id="pieUnsurPelaporan"></div>
                </div>
                <!--end::Body-->
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
    $(document).ready(function(){
        let akunData = @json($akun); 
        let unsurData = @json($unsurSetuju);
        let unsurPelaporan = @json($unsurPelaporan);
    
        let labelsAkun = akunData.map(item => item.jenis_penyelenggara);
        let seriesAkun = akunData.map(item => item.jumlah);

        let labelsUnsur = unsurData.map(item => item.unsur);
        let seriesUnsur = unsurData.map(item => item.jumlah);

        let labelUnsurPelaporan = unsurPelaporan.map(item => item.unsur)
        let seriesUnsurPelaporan = unsurPelaporan.map(item => item.jumlah)
    
        type = $('#chartType').val()

        let barOptions = {
            series: [{
                name: 'Jumlah',
                data: seriesAkun,
            }],
            chart: {
                height: 380,
                type: 'bar',
            },
            xaxis: {
                categories: labelsAkun,
                labels: {
                    style: {
                        fontSize: '6px' 
                    },
                    rotate : 315
                }
            },
            yaxis: {
                title: {
                    text: 'Jumlah'
                }
            },
            colors: ['#FF5733'],
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '10px',
                },
            },
        };

        let pieUnsur = {
                series: seriesUnsur,
                chart: {
                    width: 640,
                    type: 'pie',
                },
                labels: labelsUnsur,
                responsive: [{
                    breakpoint: 720,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'center'
                        }
                    }
                }],
                colors: ['#5C8374', '#D83F31', '#141E46', '#F4E869', '#191D88', '#40F8FF', '#614BC3', '#98346BU'],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '12px',
                    },
                },
                legend: {
                    position: 'bottom', 
                    horizontalAlign: 'left', 
                }
        };

        let pieUnsurPelaporan = {
                series: seriesUnsurPelaporan,
                chart: {
                    width: 640,
                    type: 'pie',
                },
                labels: labelUnsurPelaporan,
                responsive: [{
                    breakpoint: 720,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'center'
                        }
                    }
                }],
                colors: ['#5C8374', '#D83F31', '#141E46', '#F4E869', '#191D88', '#40F8FF', '#614BC3', '#98346BU'],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '12px',
                    },
                },
                legend: {
                    position: 'bottom', 
                    horizontalAlign: 'left', 
                }
        };
        
  
        let chartType = $('#chartType');
        let barChart = new ApexCharts(document.querySelector("#bar"), barOptions);
        let chartUnsur = new ApexCharts(document.querySelector("#pieUnsur"), pieUnsur);
        let piePelaporanUnsur = new ApexCharts(document.querySelector("#pieUnsurPelaporan"), pieUnsurPelaporan);
        
        chartUnsur.render()
        barChart.render()
        piePelaporanUnsur.render()
        
    })


</script>
@endpush