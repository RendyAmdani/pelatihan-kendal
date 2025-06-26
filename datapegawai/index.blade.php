<section class="content-header">
    <h1>
        Datapegawai<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url('')!!}"> Dashboard</a></li>
        <li class="active">Datapegawai</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(array('url' => url('')."/epersonal/datapegawai/edit", 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'simpan')) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('nip', 'NIP / Nama Pegawai:', array('class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-7">
                            <select id="nip" name="nip" class="form-control" style="width: 100%;"></select>
                        </div>
                        <div class="col-sm-1">
                            <button class="btn btn-info awal" id="kembali" type="button" title="Reset"><i class="fa fa-refresh"></i> Kembali</button>
                        </div>
                    </div>
                    <div id="detail_pegawai_page"></div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>

<script>
    function refresh_page(){
        $.ajax({
            url : "{!!url('')!!}/epersonal/biodatapegawai",
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
        $('#kembali').on('click', function(){
            refresh_page();
        });
        <?php
            echo 'var index_page=laravel_base + "/'.\Request::path().'";';
        ?>

        $('#simpan #nip').on('change', function(e){
            e.preventDefault();
            var $this =$(this);
            if($this.val() != null){
                $.ajax({
                    url : index_page + '/detailpegawai',
                    data:$(this).serialize(),
                    type : 'get',
                    beforeSend: function(){
                        preloader.on();
                    },
                    success:function(html){
                        preloader.off();
                        $('#detail_pegawai_page').html(html);
                    }
                });
            }else{
                $('#detail_pegawai_page').html('');
            }
        })

        <?php if(Input::get('nip') != '') { ?>
            autoComplete('#simpan #nip', "{!!url('epersonal/datapegawai/caripegawai')!!}", 'Ketikkan NIP atau Nama..', null, "{!!Input::get('nip')!!}", "{!!Input::get('nip')!!}");
            $('#simpan #nip').trigger('change');
        <?php } else { ?>
            autoComplete('#simpan #nip', "{!!url('epersonal/datapegawai/caripegawai')!!}", 'Ketikkan NIP atau Nama..', null);
        <?php } ?>

    });
</script>
