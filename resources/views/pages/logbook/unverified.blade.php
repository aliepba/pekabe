@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="card shadow mb-4" style="margin-top: -50px;">
        <div class="card-header py-3">
            <h4 class="h4">Form Kegiatan</h4>
        </div>
        <div class="card-body">
            <form action="{{route('unverified.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Nama Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <textarea class="form-control" name="nama_kegiatan" rows="3" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Jenis Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <select class="form-control" name="jenis_kegiatan" id="jenis_kegiatan">
                            <option value="">Pilih Jenis Kegiatan</option>
                            @foreach ($jenis as $item)
                            <option value="{{$item->id}}">{{$item->unsur_kegiatan}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Unsur Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <select class="form-control" name="id_unsur_kegiatan" id="unsur_kegiatan" required>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Penyelenggara Kegiatan<span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="nama_penyelenggara">
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Lokasi Kegiatan  <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="tempat_kegiatan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Waktu Kegiatan  <span class="text-danger">*</span></label>
                    <div class="col-5">
                        <input type="date" class="form-control" name="start_kegiatan" required>
                    </div>
                    <div class="col-5">
                        <input type="date" class="form-control" name="end_kegiatan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Klasifikasi <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <select class="form-control" name="id_klasifikasi" required>
                            <option value="">Pilih Klasifikasi</option>
                            @foreach ($klas as $item)
                                <option value="{{$item->id_klasifikasi}}">{{$item->klasifikasi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Metode Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio" name="metode" value="Tatap Muka"/>
                                <span></span>
                                Tatap Muka
                            </label>
                            <label class="radio">
                                <input type="radio" name="metode" value="Daring"/>
                                <span></span>
                                Daring
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Tingkat <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <select class="form-control" name="tingkat_kegiatan" required>
                            <option value="hehe">pilih tingkat</option>
                            <option value="1">Nasional</option>
                            <option value="2">Internasional Dalam Negeri</option>
                            <option value="3">Internasional Luar Negeri</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-2 col-form-label">Bukti Kegiatan <span class="text-danger">*</span></label>
                    <div class="col-10">
                        <input type="file" class="form-control" name="upload_persyaratan" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

@push('addon-script')
    <script>
    $('#jenis_kegiatan').change(function(){
      var id = $(this).val();
      console.log(id)
      if(id){
        $.ajax({
          type : "GET",
          url : "/get-unsur-kegiatan?id="+id,
          dataType : 'JSON',
          success:function(res){
            console.log(res)
            if(res){
              $('#unsur_kegiatan').empty();
              $("#unsur_kegiatan").append('<option>---Pilih Unsur Kegiatan---</option>');
              $.each(res,function(nama_sub_unsur,id){
                    $("#unsur_kegiatan").append('<option value="'+id+'">'+nama_sub_unsur+'</option>');
              });
            }else{
              $('#unsur_kegiatan').empty();
            }
          }
        })
      }else{
        $('#unsur_kegiatan').empty();
      }
    })
    </script>
@endpush
