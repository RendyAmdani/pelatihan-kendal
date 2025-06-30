<section class="content-header">
    <h1>
        Template sk pensiun<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url('')!!}"> Dashboard</a></li>
        <li class="active">Template sk pensiun</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border row">
            <div class="col-md-12">
                <ul class="nav nav-tabs tab1" id="myTab">
                    <li class=""><a href="{!!url('')!!}/epensiun/templateskpensiun/dpcp"> <i class="fa fa-fw fa-list-ul"></i> DPCP</a></li>
                    <li class="active"><a href="{!!url('')!!}/epensiun/templateskpensiun/dpcpmeninggal"> <i class="fa fa-fw fa-list-ul"></i> DPCP MENINGGAL</a></li>
                </ul>

                <div class="tab-pane active"><br>
                    {!! Form::open(array('url' => url('')."/epensiun/templateskpensiun/savetemplate", 'method' => 'POST', 'class'=>'form-horizontal form-'.\Config::get('claravel::ajax'),'id'=>'simpan')) !!}
                    <div class="box-body">
                        <input type='hidden' name='idskpd' id='idskpd' value="all">
                        <input type="hidden" name="jenis" class="jenis" id="jenis" value="1">
                        <div class="form-group">
                            {!! Form::label('template', 'Template:', array('class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-10">
                                <textarea rows="10" cols="600" name="template" class="ckeditor form-control" id="template" placeholder="Template Kenaikan Gaji Berkala">
                                    <?php
                                    $cek = TemplateskpensiunModel::getTemplate(session('idskpd'), 1);
                                    if($cek != 0){
                                        echo TemplateskpensiunModel::getTemplate(session('idskpd'), 1);
                                    }else{
                                        echo  TemplateskpensiunModel::getTemplate('all', 1);
                                    }
                                    ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                {!! ClaravelHelpers::btnSave() !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('select').select2();
        delete CKEDITOR.instances[ 'template' ];
        var config_pengantar = {
            toolbar : 'MyToolbar',
            height: '450'
        };
        $('.ckeditor').ckeditor(config_pengantar);

        $('ul#myTab').on('click','a',function(e){
            var str = $(this).attr('href');
            var n = str.search("dashboard");
            loading('utama');
            if(n > 0){
            }
            else{
                e.preventDefault();
                e.stopImmediatePropagation();
                preloader = new $.materialPreloader({
                    position: 'top',
                    height: '5px',
                    col_1: '#159756',
                    col_2: '#da4733',
                    col_3: '#3b78e7',
                    col_4: '#fdba2c',
                    fadeIn: 200,
                    fadeOut: 200
                });

                $.ajax({
                    type: 'get',
                    url : $(this).attr('href'),
                    beforeSend: function(){
                        preloader.on();
                    },
                    success: function(data) {
                        preloader.off();
                        $('#utama').html(data);
                    }
                });
            }
        });

        $('#simpan').on('submit',function(e){
            var $this = $(this);
            e.preventDefault();
            bootbox.confirm('Simpan data?',function(a){
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
                            if(html=='1'){
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

    function CKupdate(){
        for ( instance in CKEDITOR.instances )
            CKEDITOR.instances[instance].updateElement();
    }
</script>
