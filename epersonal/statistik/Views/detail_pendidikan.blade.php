<table class="table table-striped">
    <thead class="bg-primary">
        <tr>
            <th>No</th>
            <th>Nip</th>
            <th>Nama</th>
        </tr>
    </thead>
    <?php $x = 0; ?>
    @foreach ($detail as $item)
    <?php $x++; ?>
        <tr>
            <td>{!!$x!!}</td>
            <td>{!!$item->nip!!}</td>
            <td>{!!$item->nama!!}</td>
        </tr>
    @endforeach
</table>
