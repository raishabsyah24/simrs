<div class="row">
    <div class="col-12">
        <table>
            <tr>
                <td>Dibuat</td>
                <td>:</td>
                <td>{!! auth()->user()->name !!}</td>
            </tr>
            <tr>
                <td>Tanggal Diekspor</td>
                <td>:</td>
                <td>{!! tanggalJam(now()) !!}</td>
            </tr>
            <tr>
                <td>Periode Tanggal</td>
                <td>:</td>
                <td>{!! tanggal($data['dari']) !!} - {!! tanggal($data['sampai']) !!}</td>
            </tr>
        </table>
    </div>
</div>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Pasien</th>
            <th>Kategori</th>
            <th>Kasir</th>
            <th>Tanggal Pembayaran</th>
            <th>Metode Pembayaran</th>
            <th>Tagihan</th>
            <th>Diskon %</th>
            <th>Pajak %</th>
            <th>SubTotal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data['data'] as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{!! $item->nama_pasien !!}</td>
                <td>{!! $item->kategori_pasien !!}</td>
                <td>{!! $item->admin !!}</td>
                <td>{!! $item->metode_pembayaran !!}</td>
                <td>{!! tanggalJam($item->tanggal_pembayaran) !!}</td>
                <td>{!! formatAngka($item->total_tagihan, true) !!}</td>
                <td>{!! $item->diskon !!} %</td>
                <td>{!! $item->pajak !!} %</td>
                <td>{!! formatAngka(totalTagihan($item->kasir_id), true) !!}</td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h3>Belum Ada Data</h3>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @endforelse
        <tr>
            <td colspan="9" class="text-right">
                <h5>Grand Total</h5>
            </td>
            <td colspan="1">
                <h5>{!! formatAngka($data['grand_total'], true) !!}</h5>
            </td>
        </tr>
        <tr>
            <td colspan="10" class="text-right text-capitalize">
                <h5>{!! terbilangRupiah($data['grand_total']) !!}</h5>
            </td>
        </tr>
    </tbody>
</table>
