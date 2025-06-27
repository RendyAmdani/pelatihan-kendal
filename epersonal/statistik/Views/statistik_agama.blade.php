<div class="col-md-6" id="table-statistik">
    <table class="table table-striped" id="datatable">
    <thead class="bg-primary">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Agama</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Detail</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $x = 0;
        $total[$x] = 0;
    ?>
    @foreach ($statistik as $item)
    <?php
        $x++;
        $total[$x] = $item->jumlah;
    ?>
    <tr>
        <td class="text-center">{!! $x !!}</td>
        <td>{!! $item->agama!!}</td>
        <td class="text-center">{!! $item->jumlah!!}</td>
        <td class="text-center"><a href="#" title="Lihat Detail" class="prevdetail" recagama="{!!$item->idagama!!}" recskpd="{!!$idskpd!!}"><i class="fa fa-search"></i> Detail</a></td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"><b>Total</b></td>
            <td class="text-center"><b>{!! array_sum($total) !!}</b></td>
            <td>&nbsp;</td>
        </tr>
    </tfoot>
    </table>
</div>
<div class="col-md-6">
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>

<script>
    $(document).ready(function(){
        $('.prevdetail').on('click', function(e){
            e.preventDefault();
            var idagama = $(this).attr('recagama');
            var idskpd = $(this).attr('recskpd');

            claravel_modal('Detail Pegawai','Loading...','main_modal');
            $.ajax({
                url : '{{url('')}}/epersonal/statistik/detail',
                type : 'post',
                data : {'kategori': 2, 'idagama': idagama, 'idskpd': idskpd, '_token': '{!!csrf_token()!!}'},
                success:function(html){
                    $('#main_modal .modal-body').html(html);
                }
            });
        })

        $(function () {
            $('#container').highcharts({
                data: {
                    table: 'datatable',
                    startColumn: 1,
                    endColumn: 2,
                    endRow: $('#datatable tbody tr').length
                },
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'STATISTIK AGAMA'
                },
                yAxis: {
                    min: 0,
                    allowDecimals: false,
                    title: {
                        text: 'JUMLAH PEGAWAI'
                    }
                },
                xAxis: {
                    type: 'category'
                },
                tooltip: {
                    formatter: function () {
                        return '<b>' + this.series.name + '</b><br/>' +
                            this.point.y + ' ' + this.point.name.toLowerCase();
                    }
                }
            });
        });
    })
</script>
