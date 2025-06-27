<table class="table table-striped">
    <thead class="bg-primary">
        <tr>
            <th>No</th>
            <th>NIP<br>Nama</th>
            <th>Golongan<br>Pangkat</th>
            <th>Jabatan<br>Unit Kerja</th>
        </tr>
    </thead>
    <?php $x = 0; ?>
    @foreach ($detail as $item)
    <?php $x++; ?>
        <tr>
            <td>{!!$x!!}</td>
            <td>{!!$item->nip!!}<br>{!!$item->namalengkap!!}</td>
            <td>{!!$item->golrupkt!!}<br>{!!$item->pangkatpkt!!}</td>
            <td>{!!$item->jabatan!!}<br>{!!$item->unit!!}</td>
        </tr>
    @endforeach
</table>
