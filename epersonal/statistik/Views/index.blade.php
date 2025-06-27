<section class="content-header">
    <h1>
        Statistik<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url('')!!}"> Dashboard</a></li>
        <li class="active">Statistik</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(array('url' => \Request::path().'/statistik', 'method' => 'POST', 'class' => 'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'statistik' )) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('idskpd', 'Unit Kerja:', array('class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                            {!! comboSkpdunit("idskpd", "", "") !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('kategori', 'Kategori:', array('class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                            {!! comboKategori('kategori') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="col-sm-2 control-label"></label>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                Preview
                            </button>
                            <button type="button" class="btn btn-success" id="cetak-statistik"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-12">
                <div class="box-body" id="result"></div>
            </div>
        </div>
    </div>
</section>

<script>
    function refresh_page(){
        <?php
        echo 'var index_page=laravel_base + "/'.\Request::path().'";';
        ?>
        $.ajax({
            url : index_page,
            type : 'GET',
            beforeSend: function(){
                preloader.on();
            },
            success:function(html){
                preloader.off();
                $('#utama').html(html);
            }
        });
    }

    $(document).ready(function(){
        $('select').select2();
        $('.pagination').addClass('pagination-sm no-margin pull-right');

        <?php
        echo 'var index_page=laravel_base + "/'.\Request::path().'";';
        ?>

        $('#cetak-statistik').on('click', function(e){
            e.preventDefault();
            cetak_excel('table-statistik');
        });

        $('#statistik').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('action'),
                data:$(this).serialize(),
                type : 'post',
                beforeSend: function(){
                    $('#result').html('Looading..');
                },
                success:function(html){
                    $('#result').html(html);
                }
            });
        });
    });
</script>
