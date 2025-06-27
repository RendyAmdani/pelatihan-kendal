<html>
<head>
    <title>Print Profil Pegawai</title>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <link href="{!!url('')!!}/packages/tugumuda/css/print.css" rel="stylesheet">
    <style type="text/css">
        @media print {
            @page {
                size: F4 potrait;
                margin-left: 0.4in;
                margin-right: 0.4in;
                margin-top: 0.4in;
                margin-bottom: 0.4in;
            }
            /*p.breakhere { page-break-after: always; }*/
            .page-break	{ display:block; page-break-before:always; }
        }

        body{
            position: relative;
            width: 215mm;
            height: 960mm;
        }

        div.print{
            background: url('{!!url('')!!}/packages/tugumuda/images/print_icon.png') no-repeat;
            width:110px;
            height:110px;
            top:20;
            right:50;
            position:fixed;
            opacity:0.1;
            cursor:pointer;
        }

        div.print:hover{
            opacity:1;
        }

        hr {
            border: 1px dotted #000000;
            border-bottom: none;
            border-right: none;
            border-left: none;
        }

        table tr, td{
            font-size: 10px;
            padding: 2px;
        }

        table tbody tr td {
            padding:2px;
            vertical-align:top;
        }
    </style>
    <script type="text/javascript" src="{!!url('')!!}/packages/tugumuda/plugins/jQuery/jquery-1.11.0.min.js"></script>

</head>
<body>
<div class="print"></div>
<div class="page">
<?php
    $pict = "default.jpg";
    if(file_exists("./packages/upload/photo/pegawai/".$pegawai->photo)){
        $pict = $pegawai->photo;
    }else {
        $pict = "default.jpg";
    }
?>

@if($pegawai)
<table border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
    <td colspan="4" align="center">
        <table border="0" cellpadding="0" width="100%">
            <tr valign="top">
                <td width='15%' valign="middle" align="center"><img src="{{url('')}}/packages/tugumuda/img/logo.png" width="75"></td>
                <td width="70%" valign="top" align="center">
                    <div style="font-weight: bold; font-size: 15px; padding: 2px; letter-spacing:2px;">
                        PEMERINTAH KABUPATEN KENDAL
                    </div>
                    <div style="font-weight: bold; font-size: 15px; padding-bottom: 2px; letter-spacing:2px;">
                        BADAN KEPEGAWAIAN PENDIDIKAN DAN PELATIHAN
                    </div>
                    <div style="font-weight: bold;">
                        ----------------------- Telp. -----------------------, Fax. -----------------------<br>
                        WEBSITE : -----------------------  E-MAIL : -----------------------<br>
                    </div>
                </td>
                <td width="15%">&nbsp;</td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="4">
        <div style="border-top: 2px solid #000000; margin-bottom: 2px;"></div>
        <div style="border-top: 1px solid #000000;"></div>
    </td>
</tr>
<tr>
    <td colspan="4" align="center">
        <br><h3><b>BIODATA PEGAWAI</b></h3><br>
    </td>
</tr>
<tr><td colspan="4" bgcolor="lightblue"><div style="font-weight: bold; font-size: 14px;">LOKASI KERJA</div></td></tr>
<tr>
    <td width="">UNIT KERJA</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->unit!!}</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">SUB UNIT KERJA</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->skpd!!}</td>
    <td>&nbsp;</td>
</tr>
<tr><td colspan="4" bgcolor="lightblue"><div style="font-weight: bold; font-size: 14px;">IDENTITAS PEGAWAI</div></td></tr>
<tr>
    <td width="250">NIP</td>
    <td width="5">:</td>
    <td width="">{!!@$pegawai->nip!!}</td>
    <td width="150" rowspan="8"><img src="{!!url('')!!}/packages/upload/photo/pegawai/{!!$pict!!}" width="130" height="170"></td>
</tr>
<tr>
    <td width="">NAMA</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->namalengkap!!}</td>
</tr>
<tr>
    <td width="">TEMPAT LAHIR</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->tmlhr!!}</td>
</tr>
<tr>
    <td width="">TANGGAL LAHIR</td>
    <td width="">:</td>
    <td width="">{!!date('d-m-Y', strtotime(@$pegawai->tglhr))!!}</td>
</tr>
<tr>
    <td width="">JENIS KELAMIN</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->jenkel!!}</td>
</tr>
<tr>
    <td width="">AGAMA</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->agama!!}</td>
</tr>
<tr>
    <td width="">STATUS PEGAWAI</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->stspeg!!}</td>
</tr>
<tr>
    <td width="">JENIS KEPEGAWAIAN</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->jenkepeg!!}</td>
</tr>
<tr>
    <td width="">STATUS PERKAWINAN</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->stskawin!!}</td>
</tr>
<tr>
    <td width="">KEDUDUKAN PEGAWAI</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->jenkedudupeg!!}</td>
</tr>

<tr>
    <td width="">ALAMAT</td>
    <td width="">:</td>
    <td width="">
        {!!@$pegawai->alm!!} {!! (@$pegawai->almrt!='')? 'RT. '.@$pegawai->almrt.'':'' !!} {!! (@$pegawai->almrt!='' && @$pegawai->almrw!='' )? '/':'' !!} {!! (@$pegawai->almrw!='')? 'RW. '.@$pegawai->almrw.'':'' !!} <br/> {!! (@$pegawai->almdesa!='')? 'Desa/Kel. '.@$pegawai->almdesa.'':'' !!} {!! (@$pegawai->almkec!='')? 'Kec. '.@$pegawai->almkec.'':'' !!} {!! (@$pegawai->almkab!='')? 'Kab/Kota. '.@$pegawai->almkab.'':'' !!} <br/> {!! (@$pegawai->almprov!='')? 'Prov. '.@$pegawai->almprov.'':'' !!} {!! (@$pegawai->almkdpos!='')? 'Kode Pos.'.@$pegawai->almkdpos.'':'' !!}
    </td>
    <td>&nbsp;</td>
</tr>

<tr><td colspan="4">&nbsp;</td></tr>

<tr>
    <td width="">TELEPON</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->telp!!}</td>
    <td>&nbsp;</td>
</tr>

<tr>
    <td width="">NO KARPEG</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->nokarpeg!!}</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">NO KARTU ASKES</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->noaskes!!}</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">KARTU TASPEN</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->notaspen!!}</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">KARTU KARIS/KARSU</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->nokaris!!}</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">NPWP</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->nonpwp!!}</td>
    <td>&nbsp;</td>
</tr>

<tr><td colspan="4" bgcolor="lightblue"><div style="font-weight: bold; font-size: 14px;">PENGANGKATAN SEBAGAI CPNS</div></td></tr>

<tr>
    <td width="">NO SK CPNS</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->noskcpn!!}</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TGL SK CPNS</td>
    <td width="">:</td>
    <td width="">{!!date('d-m-Y', strtotime(@$pegawai->tgskcpn))!!}</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">PANGKAT CPNS</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->golrucpn." ".@$pegawai->pangkatcpn!!}</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TMT CPNS</td>
    <td width="">:</td>
    <td width="">{!!date('d-m-Y', strtotime(@$pegawai->tmtcpn))!!}</td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">MASA KERJA</td>
    <td width="">:</td>
    <td width="">{!!@$pegawai->mkthncpn." tahun ".@$pegawai->mkblncpn." bulan"!!}</td>
    <td>&nbsp;</td>
</tr>

<tr><td colspan="4" bgcolor="lightblue"><div style="font-weight: bold; font-size: 14px;">PENGANGKATAN SEBAGAI PNS</div></td></tr>

<tr>
    <td width="">NO SK PNS</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->noskpns?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TGL SK PNS</td>
    <td width="">:</td>
    <td width=""><?=date('d-m-Y', strtotime(@$pegawai->tgskpns))?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">PANGKAT PNS</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->golrupns." ".@$pegawai->pangkatpns?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TMT PNS</td>
    <td width="">:</td>
    <td width=""><?=date('d-m-Y', strtotime(@$pegawai->tmtpns))?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">MASA KERJA</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->mkthnpns." tahun ".@$pegawai->mkblnpns." bulan"?></td>
    <td>&nbsp;</td>
</tr>

<tr><td colspan="4" bgcolor="lightblue"><div style="font-weight: bold; font-size: 14px;">KENAIKAN PANGKAT TERAKHIR</div></td></tr>

<tr>
    <td width="">NO SK</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->noskpkt?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TGL SK</td>
    <td width="">:</td>
    <td width=""><?=date('d-m-Y', strtotime(@$pegawai->tgskpkt))?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">PANGKAT</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->golrupkt." ".@$pegawai->pangkatpkt?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TMT</td>
    <td width="">:</td>
    <td width=""><?=date('d-m-Y', strtotime(@$pegawai->tmtpkt))?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">MASA KERJA</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->mkthnpkt." tahun ".@$pegawai->mkblnpkt." bulan"?></td>
    <td>&nbsp;</td>
</tr>

<tr><td colspan="4" bgcolor="lightblue"><div style="font-weight: bold; font-size: 14px;">KENAIKAN GAJI BERKALA (KGB) TERAKHIR</div></td></tr>

<tr>
    <td width="">NO SK</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->noskkgb?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TGL SK</td>
    <td width="">:</td>
    <td width=""><?=date('d-m-Y', strtotime(@$pegawai->tgskkgb))?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TMT</td>
    <td width="">:</td>
    <td width=""><?=date('d-m-Y', strtotime(@$pegawai->tmtkgb))?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">MASA KERJA</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->mkgolthnkgb." tahun ".@$pegawai->mkgolblnkgb." bulan"?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">GAJI POKOK</td>
    <td width="">:</td>
    <td width=""><?='Rp. '.@$pegawai->gaji?></td>
    <td>&nbsp;</td>
</tr>

<tr><td colspan="4" bgcolor="lightblue"><div style="font-weight: bold; font-size: 14px;">PENDIDIKAN UMUM TERAKHIR</div></td></tr>

<tr>
    <td width="">NO IJAZAH</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->noijaz?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TGL IJAZAH</td>
    <td width="">:</td>
    <td width=""><?=date('d-m-Y', strtotime(@$pegawai->thijaz))?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TINGKAT PENDIDIKAN</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->tkpendid?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">JURUSAN PENDIDIKAN</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->jenjurusan?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">SEKOLAH / UNIVERSITAS</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->namasekolah?></td>
    <td>&nbsp;</td>
</tr>
<tr>
    <td width="">TEMPAT</td>
    <td width="">:</td>
    <td width=""><?=@$pegawai->almsekolah?></td>
    <td>&nbsp;</td>
</tr>

</table>

@else
    Data tidak ditemukan.
@endif
</div>
</body>
</html>

<script>
    $(document).ready(function(){
        //alert(window.orientation);
        $('div.print').click(function(){
            $(this).hide();
            window.print();
            /*
               setTimeout(function() {
                   window.close();
               }, 1);
               */
        });

        $('img').each(function(index,item){
            $(item).error(function(){

                $(item).attr('src','no_image.jpg');
            });
        });


        $(document).on('mouseover',function(){
            $('div.print').show();
        });

    });

</script>
