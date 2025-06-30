<section class="content-header">
    <h1>
        Nominatif Pensiun<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{!!url('')!!}"> Dashboard</a></li>
        <li class="active">Nominatif Pensiun</li>
    </ol>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <p>
                <div class="btn-group">
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button" aria-expanded="false">
                        <span class="caret"></span> Buat Baru
                    </button>
                    <ul class="dropdown-menu pull-left">
                        <a id="buatbup" href="{!!url('')!!}/epensiun/nominatifpensiun/create" class="btn"><i class="fa fa-bookmark"></i> BUP</a>
                        <a id="buataps" href="{!!url('')!!}/epensiun/nominatifpensiun/createaps" class="btn"><i class="fa fa-bookmark-o"></i> NON BUP</a>
                    </ul>
                </div>
            </p>
            <div class="col-md-12">
                {!! Form::open(array('url' => \Request::path(), 'method' => 'GET', 'class' => 'form-'.\Config::get('claravel::ajax'),'id' => 'cari' )) !!}
                {!!csrf_field()!!}
                <input type="hidden" name="page" id="pageno" value="{!!((Input::get('page') != '')?Input::get('page'):'')!!}">

                <table class="table">
                    <tr>
                        <td width="10%">Bulan</td>
                        <td width="2%">:</td>
                        <td width="38%">{!! comboBulan("bulan",Input::get('bulan'),"",".: Bulan :.") !!}</td>

                        <td width="10%">Unit Kerja</td>
                        <td width="2%">:</td>
                        <td width="38%">
                            {!! comboSkpd("idskpd",Input::get('idskpd'),"",session('idskpd'),'.: Unit Kerja :.')!!}
                        </td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td>{!! comboTahun("tahun","",".: Tahun :.") !!}</td>

                        <td>Status Proses</td>
                        <td>:</td>
                        <td>{!! comboStatussk("statussk",Input::get('statussk'),"",".: Status Proses :.")!!}</td>
                    </tr>
                    <tr>

                        <td>Pencarian</td>
                        <td>:</td>
                        <td><input type="text" class="form-control" name="search" id="search" value="{!! \Input::get('search')!!}"></td>

                        <td>Jenis Pensiun</td>
                        <td>:</td>
                        <td>{!! NominatifpensiunModel::comboJenispens("idjenpens",Input::get('idjenpens'),"",".: Jenis Pensiun :.") !!}</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
                        </td>

                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>

                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::open(array('url' => \Request::path().'/delete', 'method' => 'POST', 'class' => 'form-'.\Config::get('claravel::ajax'),'id'=>'data' )) !!}
        <div class="table-responsive">
            <div class="box-body no-padding">
                <table class="table table-striped table-hover table-condensed table-bordered" id='tabel'>
                    <thead class="bg-primary">
                        <tr>
                            <th rowspan="2"><div class="text-center">No</div></th>
                            <th rowspan="2">
                                <div class="text-center">NAMA LENGKAP</div>
                                <div class="text-center">TEMPAT,&nbsp;TGL&nbsp;LAHIR</div>
                            </th>
                            <th rowspan="2">
                                <div class="text-center">NIP</div>
                                <div class="text-center">NIP LAMA</div>
                            </th>
                            <th rowspan="2">
                                <div class="text-center">GOL.</div>
                                <div class="text-center">TMT</div>
                            </th>
                            <th rowspan="2">
                                <div class="text-center">JABATAN </div>
                                <div class="text-center">UNIT KERJA</div>
                                <div class="text-center">TMT</div>
                            </th>
                            <th colspan="2">
                                <div class="text-center">S/D</div>
                                <div class="text-center">SEKARANG </div>
                            </th>
                            <th colspan="2">
                                <div class="text-center">PENDIDIKAN</div>
                                <div class="text-center">TERAKHIR </div>
                            </th>
                            <th rowspan="2">
                                <div class="text-center">AGAMA</div>
                                <div class="text-center">USIA</div>
                            </th>
                            <th rowspan="2">
                                <div class="text-center">TMT DAN</div>
                                <div class="text-center">USIA</div>
                                <div class="text-center">PENSIUN</div>
                            </th>
                            <th rowspan="2"><div align="center">JENIS PENSIUN</div></th>
                            <th colspan="2"><div align="center">STATUS</div></th>
                            <th rowspan="2" width="7%">Act.</th>
                        </tr>
                        <tr>
                            <th><div align="center">THN</div></th>
                            <th><div align="center">BLN</div></th>
                            <th><div align="center">Tingkat</div></th>
                            <th><div align="center">Jurusan</div></th>
                            <th><div align="center">USUL</div></th>
                            <th><div align="center">Proses</div> </th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        $arr[0]= ""; $n = 0;
                        $x = (!empty(Input::get('page')))?((Input::get('page') - 1)*25):0;
                    ?>
                    @foreach ($nominatifpensiuns as $nominatifpensiun)
                    <?php
                        $x++;
                        $n++;
                        $arr[$n] = $nominatifpensiun->tmtpens.'_'.substr($nominatifpensiun->idskpd,0,2).'_'.$nominatifpensiun->jenpens; //group by 0,2 kek gini
                            if($arr[$n]!=$arr[$n-1]){
                    ?>
                            <tr>
                                <th style="position:relative;" colspan="18" align="left">
                                    TMT PENSIUN <i class="icon-calendar"></i> <?php echo date("d-m-Y", strtotime($nominatifpensiun->tmtpens))?> -
                                    <?php
                                        if(Input::get('idskpd') != ''){
                                            echo getSkpd(Input::get('idskpd'));
                                        }else{
                                            if(session('role_id') == 4){
                                                if(strlen(session('idskpd')) == 2){
                                                    echo getSkpd(substr($nominatifpensiun->idskpd,0,2));
                                                }else{
                                                    echo getSkpd(substr($nominatifpensiun->idskpd,0,5));
                                                }
                                            }else{
                                                echo getSkpd(substr($nominatifpensiun->idskpd,0,2));
                                            }
                                        }
                                    ?>
                                    -
                                    {!!$nominatifpensiun->jenpens!!}

                                </th>
                            </tr>
                    <?php } ?>
                    <tr>
                        <td>{!!$x!!}</td>
                        <td>
                            <div class="text-left">{!! $nominatifpensiun->namalengkap !!}</div>
                            <small><div class="text-left">{!! $nominatifpensiun->tmlhr !!}, {!! tglina($nominatifpensiun->tglhr) !!}</div></small>
                            <div class="text-right" style="position:relative">
                                <?php
                                    if($nominatifpensiun->iscetaksk == 1){
                                        echo '<div style="position:absolute;right:-12px;top:-5px;color:#ffcc00;"><i class="fa fa-star" title="Sudah Cetak Pensiun"></i></div>';
                                    }else if($nominatifpensiun->iscetaksk == 2){
                                        echo '<div style="position:absolute;right:-12px;top:-5px;color:#000000;"><i class="fa fa-star" title="Sudah Cetak Pensiun"></i></div>';
                                    }
                                ?>
                            </div>
                        </td>
                        <td>
                            <div class="text-center">{!! $nominatifpensiun->nip !!}</div>
                            <div class="text-center">{!! $nominatifpensiun->niplama !!}</div>
                        </td>
                        <td>
                            <small>
                                <div class="text-left">{!! $nominatifpensiun->golru !!}</div>
                                <div class="text-left">{!!(($nominatifpensiun->tmtpkt!='0000-00-00')?date('d-m-Y', strtotime($nominatifpensiun->tmtpkt)):'')!!}</div>
                            </small>
                        </td>
                        <td>
                            <div class="text-left">{!!strtoupper(($nominatifpensiun->jabatan!='')?$nominatifpensiun->jabatan:'-')." PADA ".(($nominatifpensiun->path_short !='-')?$nominatifpensiun->path_short:'')!!}</div>
                            <div class="text-left">{!!(($nominatifpensiun->tmtjbt != '0000-00-00')?date('d-m-Y', strtotime($nominatifpensiun->tmtjbt)):'')!!}</div>
                        </td>
                        <td>
                            <div class="text-center">{!!$nominatifpensiun->mkthnpkt!!}</div>
                        </td>
                        <td>
                            <div class="text-center">{!!$nominatifpensiun->mkblnpkt!!}</div>
                        </td>
                        <td>
                            <div class="text-center">{!!$nominatifpensiun->tkpendid!!}</div>
                        </td>
                        <td>
                            <div class="text-left">{!!$nominatifpensiun->jenjurusan!!}</div>
                        </td>
                        <td>
                            @if($nominatifpensiun->usia!='')
                                <div class="text-left">{!!$nominatifpensiun->agama!!}</div>
                                <div class="text-left">{!! substr($nominatifpensiun->usia,0,2)." thn ".substr($nominatifpensiun->usia,2,2)." bln"!!}</div>
                            @else
                                <div class="text-left">{!!$nominatifpensiun->agama."<br> 0 thn 0 bln"!!}</div>
                            @endif
                        </td>
                        <td>
                                <div class="text-left">{!!($nominatifpensiun->tmtpens != '0000-00-00')?"TMT : ".date('d-m-Y', strtotime($nominatifpensiun->tmtpens)):'' !!}</div>
                                <div class="text-left">{!!$nominatifpensiun->usiapens!!} thn</div>
                        </td>
                        <td>
                            <div class="text-left">{!!$nominatifpensiun->jenpens!!}</div>
                        </td>
                        <td>
                            <?php
                                if($nominatifpensiun->statususul==1){
                                    echo '<span style="color:green"><i class="fa fa-check-circle" title="Memenuhi Syarat"/><span>';
                                }else if($nominatifpensiun->statususul==2){
                                    echo '<span style="color:red"><i class="fa fa-times-circle" title="Tidak Memenuhi Syarat"/></span>';
                                }else if($nominatifpensiun->statususul==3){
                                    echo '<span style="color:orange"><i class="fa fa-info-circle" title="Berkas Tidak Lengkap"/></span>';
                                }else{
                                    echo '-';
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if($nominatifpensiun->statususul=='1' && $nominatifpensiun->statussk=='2'){
                                    echo '<span style="color:orange"><i class="fa fa-clock-o" title="Sedang diproses"/><span>';
                                }else if($nominatifpensiun->statussk=='1'){
                                    echo '<span style="color:green"><i class="fa fa-check-circle" title="Selesai diproses"/></span>';
                                }else {
                                    echo '-';
                                }
                            ?>
                        </td>

                        <td>
                            <div class="btn-group" style="margin-bottom: 10px;">
                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false" style="width: 135px;">
                                    <span class="caret"></span> Aksi
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    @if($nominatifpensiun->iscetaksk != 1)
                                    <li><a href="javascript:void(0)" class="text-info editpensiun" recnip="{!!$nominatifpensiun->nip!!}"><i class="fa fa-pencil-square-o"></i> Edit</a></li>
                                    @endif
                                    <li><a href="javascript:void(0)" class="text-info verifikasipensiun" recnip="{!!$nominatifpensiun->nip!!}"><i class="{!!((session('role_id') < 3))?'fa fa-check-square-o':'fa fa-search'!!}"></i> {!!((session('role_id') < 3))?'Verifikasi':'Preview'!!}</a></li>
                                    @if($nominatifpensiun->jenispensiun == '2')
                                          <li><a id="cetaksk" href="{!!url('')!!}/epensiun/nominatifpensiun/cetakskmen/{!!$nominatifpensiun->nip!!}" class="text-info" target="_blank"><i class="fa fa-print"></i> Cetak DPCP men</a></li>
                                    @else
                                          <li><a id="cetaksk" href="{!!url('')!!}/epensiun/nominatifpensiun/cetaksk/{!!$nominatifpensiun->nip!!}" class="text-info" target="_blank"><i class="fa fa-print"></i> Cetak DPCP</a></li>
                                    @endif
                                    @if($nominatifpensiun->statussk != 1)
                                    <li><a id="hapus" href="javascript:void(0)" recnip="{!!$nominatifpensiun->nip!!}" class="text-danger"><i class="fa fa-times-circle"></i> Hapus</a></li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <br>
                <div>
                    <table border="0" class="table">
                        <tr>
                            <td colspan="11">Keterangan :<br></td>
                        </tr>
                        <tr>
                            <td>
                                <span style="color:green"><i class="fa fa-check-circle" title="Memenuhi Syarat"/></span> Memenuhi Syarat<br>
                            </td>
                            <td>
                                <span style="color:red"><i class="fa fa-times-circle" title="Tidak Memenuhi Syarat"/></span> Tidak Memenuhi Syarat<br>
                            </td>
                            <td>
                                <span style="color:orange"><i class="fa fa-info-circle" title="Berkas Tidak Lengkap"/></span> Berkas Tidak Lengkap<br>
                            </td>
                            <td>
                                <span style="color:orange"><i class="fa fa-clock-o" title="Sedang diproses"/></span> Sedang Diproses<br>
                            </td>
                            <td>
                                <span style="color:green"><i class="fa fa-check-circle" title="Selesai diproses"/></span> Selesai diproses<br>
                            </td>
                            <td>
                                <span style="color:#ffcc00"><i class="fa fa-star" title="Sudah cetak Pensiun"/></span> Sudah Cetak Pensiun<br>
                            </td>
                            <td>
                                <span style="color:#000000"><i class="fa fa-star" title="Pensiun Dibatalkan"/></span> Pensiun Dibatalkan<br>
                            </td>
                        </tr>
                    </table>
                </div><br>
            </div>
        </div>
        <div class="box-footer clearfix">
          <div class="row">
            <div class="col-sm-6">
              {!! ClaravelHelpers::btnDeleteAll() !!}
            </div>
            <div class="col-sm-6">
              <?php echo $nominatifpensiuns->appends(array('search' => Input::get('search')))->render(); ?>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
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
        $('.checkme,.checkall').on('change',function(){
            if($(this).is(':checked'))
                $('#deleteall').fadeIn(300);
            else
                $('#deleteall').fadeOut(300);
        });

        $('#buatbup').on('click',function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('href'),
                type : 'get',
                beforeSend: function(){
                    preloader.on();
                },
                success:function(html){
                    preloader.off();
                    $('#utama').html(html);
                }
            });
        });

        $('#buataps').on('click',function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('href'),
                type : 'get',
                beforeSend: function(){
                    preloader.on();
                },
                success:function(html){
                    preloader.off();
                    $('#utama').html(html);
                }
            });
        });

        <?php
        echo 'var index_page=laravel_base + "/'.\Request::path().'";';
        ?>

        $('#tabel').on('click','#hapus',function(e){
            e.preventDefault();
            var $this =$(this);
            bootbox.confirm('Hapus?',function(a){
                if(a == true){
                    $.ajax({
                        url : index_page + '/delete',
                        type : 'post',
                        data: {'id' : $this.attr('recid'), '_token' : '{!!csrf_token()!!}'},
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            preloader.off();
                            if(html=='9'){
                                notification('Berhasil Dihapus','success');
                                $this.closest('tr').fadeOut(300,function(){
                                    $(this).remove();
                                });
                            }else{
                                notification(html,'danger');
                            }
                        }
                    });
                }
            });
        });
        $('#tabel').on('click','#edit',function(e){
            e.preventDefault();
            var $this =$(this);
            bootbox.confirm('Edit?',function(a){
                if(a == true){
                    $.ajax({
                        url : index_page + '/edit',
                        type : 'get',
                        data:'id=' + $this.attr('recid'),
                        beforeSend: function(){
                            preloader.on();
                        },
                        success:function(html){
                            preloader.off();
                            $('#utama').html(html);
                        }
                    });
                }
            });
        });
        $('#cari').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('action'),
                data:$(this).serialize(),
                type : 'get',
                beforeSend: function(){
                    preloader.on();
                },
                success:function(html){
                    preloader.off();
                    $('#utama').html(html);
                }
            });
        });
        $('a.editpensiun').on('click', function(e){
            e.preventDefault();
            claravel_modal('Edit Nominatif Pensiun','Loading...','main_modal2');
            $.ajax({
                type:'post',
                url : "{!!url('')!!}/epensiun/nominatifpensiun/data/editpensiun",
                data: {'nip': $(this).attr('recnip'), '_token' : '{!!csrf_token()!!}'},
                success:function(html){
                    $('#main_modal2 .modal-body').html(html);
                }
            });

        });

        $('a.verifikasipensiun').on('click', function(e){
            e.preventDefault();
            claravel_modal('Verifikasi Nominatif Pensiun','Loading...','main_modal2');
            $.ajax({
                type:'post',
                url : "{!!url('')!!}/epensiun/nominatifpensiun/data/verifikasipensiun",
                data: {'nip': $(this).attr('recnip'), '_token' : '{!!csrf_token()!!}'},
                success:function(html){
                    $('#main_modal2 .modal-body').html(html);
                }
            });

        });
    });
</script>
