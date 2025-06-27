<div class="form-group">
    {!! Form::label('nama', 'Nama :', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-2">
        {!! Form::text('gdp', null, array('class'=> 'form-control awal', 'id'=>'gdp', 'placeholder'=>'Ex: Drs. ')) !!}
    </div>
    <div class="col-sm-3">
        {!! Form::text('nama', null, array('class'=> 'form-control awal', 'placeholder'=>'Nama Lengkap')) !!}
    </div>
    <div class="col-sm-2">
        {!! Form::text('gdb', null, array('class'=> 'form-control awal', 'id'=>'gdb', 'placeholder'=>'Ex: SE, M.Kom')) !!}
    </div>
    <div class="col-sm-1">
        <button class="btn btn-success awal" type="submit" id=""><i class="fa fa-floppy-o"></i> Simpan</button>
    </div>
</div>
<div class="form-group">
    {!! Form::label('tmlhr', 'Kelahiran :', array('class' => 'col-sm-2 control-label')) !!}
    <div class="col-sm-4">
        {!! Form::text('tmlhr', null, array('class'=> 'form-control awal', 'placeholder'=>'Temat Lahir')) !!}
    </div>
    <div class="col-sm-3">
        <div class='input-group datepicker'>
            {!! Form::text('tglhr', null, array('class'=> 'form-control date awal', 'id'=>'tglhr', 'placeholder'=>'Tanggal Lahir')) !!}
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <div class="col-md-1">
        <a href="{!!url('')!!}/epersonal/biodatapegawai/print/{!!$nip!!}" class="btn btn-primary awal print" title="Print Biodata" target="_blank"><i class="fa fa-print"></i> Cetak &nbsp;&nbsp;&nbsp;</a>
    </div>
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#biodata" aria-controls="biodata" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-home"></span> Biodata
        </a>
    </li>
    <li role="presentation">
        <a href="#jabatan" aria-controls="jabatan" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-user"></span> Jabatan Terakhir
        </a>
    </li>
    <li role="presentation">
        <a href="#golongan" aria-controls="golongan" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-user"></span> Golongan
        </a>
    </li>
    <li role="presentation">
        <a href="#pendidikan" aria-controls="pendidikan" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-cog"></span> Pendidikan Terakhir
        </a>
    </li>
    <li role="presentation">
        <a href="#riwayat" aria-controls="riwayat" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-envelope"></span> Riwayat
        </a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="biodata">
        <div id="biodata" class="tab-pane active">
        <p>
        <div class="box-header with-border">
            <b class="box-title"><small>BIODATA PRIBADI</small></b>
        </div>
        </p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('idagama', 'Agama:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboAgama("idagama","","") !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('idjenkel', 'Jenis Kelamin:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <input type="radio" id="idjenkel1" value="1" name="idjenkel"> Laki-laki
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="idjenkel2" value="2" name="idjenkel"> Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-group stskawin">
                    {!! Form::label('idstskawin', 'Status Marital :', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboStsmarital("idstskawin","","") !!}
                    </div>
                </div>
                <div class="form-group stsdujan">
                    {!! Form::label('idstsdujan', 'Status Duda/Janda :', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboStsDujan("idstsdujan","idstsdujan","") !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('idgoldarah', 'Golongan Darah:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboGoldarah("idgoldarah","","") !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('alm', 'Alamat:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('alm', null, array('class'=> 'form-control', 'placeholder'=> 'Alamat')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('almrt', 'RT:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-3">
                        {!! Form::text('almrt', null, array('class'=> 'form-control num', 'placeholder'=> 'RT', 'maxlength'=>3)) !!}
                    </div>
                    <div class="col-sm-1" style="margin-top: 7px;">
                        <b>RW: </b>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::text('almrw', null, array('class'=> 'form-control num', 'id'=>'almrw', 'placeholder'=> 'RW', 'maxlength'=>3)) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('almdesa', 'Desa/Kelurahan:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('almdesa', null, array('class'=> 'form-control', 'placeholder'=> 'Desa/Kelurahan')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('almkec', 'Kecamatan:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('almkec', null, array('class'=> 'form-control', 'placeholder'=> 'Kecamatan')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('almkab', 'Kabupaten/Kota:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('almkab', null, array('class'=> 'form-control', 'placeholder'=> 'Kabupaten')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('almprov', 'Provinsi:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('almprov', null, array('class'=> 'form-control', 'placeholder'=> 'Provinsi')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('almkdpos', 'Kode POS:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('almkdpos', null, array('class'=> 'form-control', 'placeholder'=> 'Kode Pos', 'maxlength'=>6)) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('telp', 'Telepon:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('telp', null, array('class'=> 'form-control', 'placeholder'=> 'Telepon')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('hp', 'No HP:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('hp', null, array('class'=> 'form-control', 'placeholder'=> 'Handphone')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email_dinas', 'E-Mail Gov:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('email_dinas', null, array('class'=> 'form-control', 'placeholder'=> 'E-Mail Dinas')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'E-Mail Pribadi:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('email', null, array('class'=> 'form-control', 'placeholder'=> 'E-Mail')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('nokarpeg', 'No. Karpeg/KPE:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('nokarpeg', null, array('class'=> 'form-control', 'placeholder'=> 'No. Karpeg/KPE')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('noaskes', 'No. Askes:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('noaskes', null, array('class'=> 'form-control', 'placeholder'=> 'No. Askes')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('notaspen', 'Taspen:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('notaspen', null, array('class'=> 'form-control', 'placeholder'=> 'Taspen')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('nokaris', ' No. Karis/Karsu:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('nokaris', null, array('class'=> 'form-control', 'placeholder'=> 'Karis/Karsu')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('nonpwp', 'NPWP:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('nonpwp', null, array('class'=> 'form-control', 'placeholder'=> 'NPWP')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('noktp', 'No. KTP:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('noktp', null, array('class'=> 'form-control', 'placeholder'=> 'No. KTP')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('nobapertarum', 'Bapertarum:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('nobapertarum', null, array('class'=> 'form-control', 'placeholder'=> 'Bapertarum')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <div role="tabpanel" class="tab-pane" id="jabatan">
        <div class="row">
            <div class="col-md-6">
                <p>
                <div class="box-header with-border">
                    <b class="box-title"><small>LOKASI KERJA</small></b>
                </div>
                </p>
                <div class="form-group div-disabled">
                    {!! Form::label('kdunit', 'Unit Kerja:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboSkpdunit("kdunit","","") !!}
                    </div>
                </div>
                <div class="form-group div-disabled">
                    {!! Form::label('idskpd', 'Sub Unit Kerja:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <select name="idskpd" class="form-control" id="idskpd" data-placeholder=".: Pilihan :." style="width: 100%"></select>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('idstspeg', 'Status Pegawai:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <input type="radio" name="idstspeg" id="idstspeg1" value="1" checked=""> CPNS
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="idstspeg" id="idstspeg2" value="2"> PNS
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="idstspeg" id="idstspeg3" value="3"> PPPK
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('idjenkepeg', 'Jenis Kepegawaian:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboJenkepeg("idjenkepeg","","") !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('idjenkedudupeg', 'Kedudukan Pegawai:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboJenkedudupeg("idjenkedudupeg","","") !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 div-disabled">
                <p>
                <div class="box-header with-border">
                    <b class="box-title"><small>JABATAN TERAKHIR</small></b>
                </div>
                </p>
                <div class="form-group">
                    {!! Form::label('pejmenjbt', 'Pejabat Menetapkan:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboPenetapsk("pejmenjbt","","") !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('idjenjab','Jenis Jabatan:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboJenjab("idjenjab","","") !!}
                    </div>
                </div>

                <div class="form-group xjabstruk">
                    {!! Form::label('idjabjbt', 'Jabatan Struktural:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <select name="idjabjbt" class="form-control" id="idjabjbt" data-placeholder=".: Pilihan :." style="width: 100%"></select>
                    </div>
                </div>

                <div class="form-group xjabfung">
                    {!! Form::label('idjabfung', 'Jabatan Fungsional:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <select name="idjabfung" class="form-control" id="idjabfung" data-placeholder=".: Pilihan :." style="width: 100%"></select>
                    </div>
                </div>

                <div class="form-group xjabfungum">
                    {!! Form::label('idjabfungum', 'Jabatan Pelaksana:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <select name="idjabfungum" class="form-control" id="idjabfungum" data-placeholder=".: Pilihan :." style="width: 100%"></select>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('noskjbt', ' NO. SK Jab:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('noskjbt', null, array('class'=> 'form-control', 'placeholder'=> 'No. SK Jabatan')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('tgskjbt', 'TGL. SK Jab:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <div class='input-group datepicker'>
                            {!! Form::text('tgskjbt', null, array('class'=> 'form-control date', 'placeholder'=> 'dd-mm-yyyy')) !!}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('tmtjbt', 'TMT Jab:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <div class='input-group datepicker'>
                            {!! Form::text('tmtjbt', null, array('class'=> 'form-control date', 'placeholder'=> 'dd-mm-yyyy')) !!}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="golongan">
        <div class="row">
            <div class="col-md-6 div-disabled">
                <p>
                <div class="box-header with-border">
                    <b class="box-title"><small>PANGKAT TERAKHIR</small></b>
                </div>
                </p>

                <div class="form-group">
                    {!! Form::label('pejmenpkt', 'Pejabat Menetapkan:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboPenetapsk("pejmenpkt","","") !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('idgolrupkt', 'Golongan Ruang:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboGolru("idgolrupkt","","") !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('noskpkt', ' NO. SK Gol.:', array('class' => 'col-sm-3 control-label', 'placeholder'=> 'NO. SK Gol.')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('noskpkt', null, array('class'=> 'form-control', 'placeholder'=> 'NO. SK Gol.')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('tgskpkt', ' TGL. SK Gol.:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <div class='input-group datepicker'>
                            {!! Form::text('tgskpkt', null, array('class'=> 'form-control date', 'placeholder'=> 'dd-mm-yyyy')) !!}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('tmtpkt', 'TMT Gol.:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <div class='input-group datepicker'>
                            {!! Form::text('tmtpkt', null, array('class'=> 'form-control date', 'placeholder'=> 'dd-mm-yyyy')) !!}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('mkthnpkt', 'Masa Kerja:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-2">
                        {!! Form::text('mkthnpkt', null, array('class'=> 'form-control num', 'maxlength'=> '2', 'placeholder'=> '00')) !!}
                    </div>
                    <div class="col-sm-1" style="margin-top: 7px;">
                        Tahun
                    </div>
                    <div class="col-sm-2">
                        {!! Form::text('mkblnpkt', null, array('class'=> 'form-control num', 'id'=> 'mkblnpkt', 'maxlength'=> '2', 'placeholder'=> '00')) !!}
                    </div>
                    <div class="col-sm-1" style="margin-top: 7px;">
                        Bulan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="pendidikan">
        <div class="row">
            <div class="col-md-6 div-disabled">
                <p>
                <div class="box-header with-border">
                    <b class="box-title"><small>PENDIDIKAN AKHIR</small></b>
                </div>
                </p>

                <div class="form-group">
                    {!! Form::label('idtkpendid', 'Pendidikan Terakhir:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! comboTkpendidikan($id="idtkpendid",$sel="",$required="") !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('idjenjurusan', 'Jurusan:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        <select name="idjenjurusan" class="form-control" id="idjenjurusan" data-placeholder=".: Pilihan :." style="width: 100%"></select>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('noijaz', ' Nomor Ijazah:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('noijaz', null, array('class'=> 'form-control', 'placeholder'=> 'Nomor Ijazah')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('thijaz', ' Tahun Lulus:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('thijaz', null, array('class'=> 'form-control num', 'maxlength'=> '4', 'placeholder'=> 'Tahun Lulus')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('namasekolah', ' Nama Sekolah / Kampus:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('namasekolah', null, array('class'=> 'form-control', 'placeholder'=> 'Nama Sekolah / Kampus')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('almsekolah', ' Alamat Sekolah / Kampus:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('almsekolah', null, array('class'=> 'form-control', 'placeholder'=> 'Alamat Sekolah / Kampus')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('kepsek', ' Kepala Sekolah / Rektor:', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-7">
                        {!! Form::text('kepsek', null, array('class'=> 'form-control', 'placeholder'=> 'Kepala Sekolah / Rektor')) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6 div-disabled">&nbsp;</div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="riwayat">
        <h3>Riwayat</h3>
        <p>Get in touch with us using the information below or fill out the contact form.</p>
    </div>
</div>

<script>
    $(document).ready(function(){
        loadBiodata();
        $('#detail_pegawai_page select').select2();
        $('#simpan .xjabstruk, #simpan .xjabfung, #simpan .xjabfungum').hide();
        $('#simpan #idtkpendid').on('change', function(e){
            e.preventDefault();
            autoComplete('#simpan #idjenjurusan', '{!!url('')!!}/epersonal/datapegawai/jenjurusan', '.: Pilihan :.', null, '', '',  $(this).val());
        });

        $('#simpan #kdunit').on('change', function(e){
            e.preventDefault();
            autoComplete('#simpan #idskpd', '{!!url('')!!}/epersonal/datapegawai/skpdunit', '.: Pilihan :.', null, $(this).val(), $(this).find(":selected").text(),  $(this).val());
        });

        $('#simpan #idskpd').on('change', function(e){
            e.preventDefault();
            autoComplete('#simpan #idjabjbt', '{!!url('')!!}/epersonal/datapegawai/jabstruk', '.: Pilihan :.', null, '', '', $(this).val());
        });

        $('#simpan #idjenjab').on('change', function(e){
            e.preventDefault();
            var idjenjab = $(this).val();
            if(idjenjab > 4){
                $('#simpan .xjabstruk').fadeIn();
                $('#simpan .xjabfung, #simpan .xjabfungum').fadeOut();
            }else if(idjenjab == 2){
                $('#simpan .xjabfung').fadeIn();
                $('#simpan .xjabstruk, #simpan .xjabfungum').fadeOut();
            }else if(idjenjab == 3){
                $('#simpan .xjabfungum').fadeIn();
                $('#simpan .xjabstruk, #simpan .xjabfung').fadeOut();
            }else{
                $('#simpan .xjabstruk, #simpan .xjabfung, #simpan .xjabfungum').fadeOut();
            }
        });

        autoComplete('#simpan #idjabfung', '{!!url('')!!}/epersonal/datapegawai/jabfung', '.: Pilihan :.', null, '', '', '');
        autoComplete('#simpan #idjabfungum', '{!!url('')!!}/epersonal/datapegawai/jabfungum', '.: Pilihan :.', null, '', '', '');

        $('#simpan').on('submit',function(e){
            var $this = $(this);
            e.preventDefault();
            bootbox.confirm('Yakin untuk menyimpan data ?',function(a){
                if (a == true){
                    $.ajax({
                        url : $this.attr('action'),
                        type : 'POST',
                        data : $this.serialize(),
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            preloader.off();
                            if(html==4){
                                notification('Berhasil Disimpan','success');
                            }else{
                                notification(html,'danger');
                            }
                        }
                    });
                }
            });
        });
    });

    function loadBiodata(){
        var nip = $('#simpan #nip').val();
        $.ajax({
            url  : '{!!url('')!!}/epersonal/datapegawai/detailpegawai',
            type : 'POST',
            data : {'nip': nip, '_token' : '{!!csrf_token()!!}'},
            beforeSend: function(){
                preloader.on();
            },
            success:function(response){
                preloader.off();
                var ret = $.parseJSON(response);
                var arrdate = new Array("tglhr","tgskjbt","tmtjbt","tgskcpn","tmtcpn","tgspmtcpn","tmtspmtcpn","tgskpns","tmtpns","tgspmtpns","tmtspmtpns","tgskpkt","tmtpkt","tgskkgb","tmtkgb","tgskcalonawal_pppk","tgskawal_pppk","tgljanjiawal_pppk","tmtmulaiawal_pppk","tmtakhirawal_pppk","tgskakhir_pppk","tgljanjiakhir_pppk","tmtmulaiakhir_pppk","tmtakhirakhir_pppk");
                var arraytext = new Array("skpdunit");
                var arrayradio = new Array("idjenkel","idstspeg","hari_kerja","isttb");
                var arrselect2 = new Array("idagama","idstskawin","idgoldarah","idjenkepeg","idjenkedudupeg","idskpd","kdunit","pejmenjbt","idjenjab","pejmenpkt","idgolrupkt","idtkpendid");

                if(ret){
                    for(attrname in ret){
                        $('#simpan #id').val(ret.nip);
                        $('#simpan #'+attrname).val(ret[attrname]);
                        if($.inArray(attrname,arraytext)!=-1){
                            $('#'+attrname).html('(<i class="fa fa-fw fa-map-marker"></i>'+ret[attrname]+')');
                        }
                        if($.inArray(attrname,arrayradio)!=-1){
                            $('input[name='+attrname+'][value='+ret[attrname]+']').prop('checked',true);
                        }
                        if($.inArray(attrname,arrselect2)!=-1){
                            $('#simpan #'+attrname).select2('val',ret[attrname]);
                        }
                        if($.inArray(attrname,arrdate)!=-1){
                            var str = ret[attrname];
                            var res = str.split("-");
                            $('#simpan #'+attrname).val(res[2]+'-'+res[1]+'-'+res[0]);
                        }
                    }

                    $("#simpan #idskpd").data('select2').trigger('select', {
                        data: {"id":ret.idskpd,"text":ret.skpd}
                    });

                    $("#simpan #idjenjurusan").data('select2').trigger('select', {
                        data: {"id":ret.idjenjurusan,"text":ret.jenjurusan}
                    });

                    $("#simpan #idjabfung").data('select2').trigger('select', {
                        data: {"id":ret.idjabfung,"text":ret.jabfung}
                    });

                    $("#simpan #idjabfungum").data('select2').trigger('select', {
                        data: {"id":ret.idjabfungum,"text":ret.jabfungum}
                    });

                    $('#simpan #idjenjab').trigger('change');
                }
            }
        });
    }
</script>
