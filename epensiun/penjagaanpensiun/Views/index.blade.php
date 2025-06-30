<section class="content-header">
    <h1>
        Penjagaanpensiun<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url('')!!}"> Dashboard</a></li>
        <li class="active">Penjagaanpensiun</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(array('url' => \Request::path(), 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'nominatif-pegawai', 'target'=>'_blank')) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('idskpd', 'Unit Kerja:', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-7">
                            {!!comboSkpd("idskpd","","",session('idskpd'))!!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('idjenjab', 'Jenis Jabatan:', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-4">
                            {!! comboJenjab("idjenjab","","") !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('idstspeg', 'Jenis Pegawai:', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-4">
                            {!! comboStspns("idstspeg","","") !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('bulan1', 'Bulan Antara:', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-2">
                            {!! comboBulan("bulan1","","") !!}
                        </div>
                        <div class="col-sm-2">
                            {!! comboBulan("bulan2","","") !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('tahun', 'Tahun:', array('class' => 'col-sm-3 control-label')) !!}
                        <div class="col-sm-2">
                            {!! comboTahun("tahun",date('Y'),"") !!}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button class="btn btn-success" type="button" id="prev-nominatif"><i class="fa fa-list-ul"></i> Lihat Nominatif</button>
                            &nbsp;&nbsp;
                            <button class="btn btn-success" type="button" id="cetak-nominatif"><i class="fa fa-print"></i> Cetak Nominatif</button>
                            &nbsp;&nbsp;
                            <button class="btn btn-success" type="button" id="excel-nominatif"><i class="fa fa-file-excel-o"></i> Download Excel</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-12">
                <div id="result" class="table-responsive"></div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('select').select2();

        $('#data').on('submit',function(e){
            e.preventDefault();
            var iki = $(this);
            bootbox.confirm('Hapus?',function(r){
                if(r){
                    $.ajax({
                        url : iki.attr('action') + '/delete',
                        type : 'post',
                        data:iki.serialize(),
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            preloader.off();
                            notification(html,'success');
                            iki.find('input[type=checkbox]').each(function (t){
                                if($(this).is(':checked')){
                                    $(this).closest('tr').fadeOut(100)
                                }
                            });
                            $('#deleteall').fadeOut(300);
                        }
                    });
                }
            });
        });

        $('#prev-nominatif').on('click', function(e){
            e.preventDefault();
            $.ajax({
                url : "{!!url('')!!}/epensiun/penjagaanpensiun/data/nominatif",
                type : 'post',
                data : $('#nominatif-pegawai').serialize(),
                beforeSend:function(){
                    $('#result').html('<i class="fa fa-spinner"></i> Loading...');
                },
                success:function(response){
                    $('#result').html(response);
                }
            });
        });

        $('#cetak-nominatif').on('click', function(e){
            e.preventDefault();
            $('#nominatif-pegawai').attr("action", "{!!url('')!!}/epensiun/penjagaanpensiun/print/nominatif");
            $('#nominatif-pegawai').submit();
        });

        $('#excel-nominatif').on('click', function(e){
            e.preventDefault();
            $('#nominatif-pegawai').attr("action", "{!!url('')!!}/epensiun/penjagaanpensiun/excel/nominatif");
            $('#nominatif-pegawai').submit();
            /*cetak_excel('result');*/
        });
    });
</script>
