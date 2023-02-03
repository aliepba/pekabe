<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="text-sm font-weight-bolder text-dark">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Nama Penanggungjawab" name="nama_penanggung_jawab" value="{{$data->penanggungjawab->nama_penanggung_jawab}}" required/>
        </div>
        <div class="form-group">
            <label class="text-sm font-weight-bolder text-dark">NIK <span class="text-danger">*</span></label>
            <input type="number" class="form-control" placeholder="NIK" name="nik" value="{{$data->penanggungjawab->nik}}" required/>
        </div>
        <div class="form-group">
            <label class="text-sm font-weight-bolder text-dark">NPWP <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="NPWP" name="npwp" id="npwp" value="{{$data->penanggungjawab->npwp}}" required/>
        </div>
        <div class="form-group">
            <label class="text-sm font-weight-bolder text-dark">Berkas SK Penunjukan <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="upload_persyaratan" required/>
            <span class="text-muted">Accepted formats: pdf Max file size 1Mb</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="text-sm font-weight-bolder text-dark">Jabatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Jabatan" name="jabatan" value="{{$data->penanggungjawab->jabatan}}" required/>
        </div>
        <div class="form-group">
            <label class="text-sm font-weight-bolder text-dark">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="Email" name="email" value="{{$data->penanggungjawab->email}}" required/>
        </div>
        <div class="form-group">
            <label class="text-sm font-weight-bolder text-dark">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" placeholder="Password" name="password" value="{{$data->penanggungjawab->password}}" required/>
        </div>
    </div>
</div>
