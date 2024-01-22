<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <title>TES - Venturo Camp</title>
    <style>
        td,
        th {
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-3">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <select name="tahun" class="form-control" id="my-select">
                                    <option value="">Pilih Tahun</option>
                                    <option value="2021" @selected($tahun == 2021)>2021</option>
                                    <option value="2022" @selected($tahun == 2022)>2022</option>
                                </select>
                            </div>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary" type="submit">Tampilkan</button>
                    </div>
                    </form>
                </div>
                <hr>
                <div class="">
                    @isset($data)
                        <div class="table table-responsive">
                            <table class="table table-hover table-bordered" style="margin: 0;">
                                <thead>
                                    <tr class="table-dark">
                                        <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">
                                            Menu
                                        </th>
                                        <th colspan="12" style="text-align: center;">Periode Pada {{ $tahun }}
                                        </th>
                                        <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">
                                            Total
                                        </th>
                                    </tr>
                                    <tr class="table-dark">
                                        <th style="text-align: center;width: 75px;">Jan</th>
                                        <th style="text-align: center;width: 75px;">Feb</th>
                                        <th style="text-align: center;width: 75px;">Mar</th>
                                        <th style="text-align: center;width: 75px;">Apr</th>
                                        <th style="text-align: center;width: 75px;">Mei</th>
                                        <th style="text-align: center;width: 75px;">Jun</th>
                                        <th style="text-align: center;width: 75px;">Jul</th>
                                        <th style="text-align: center;width: 75px;">Ags</th>
                                        <th style="text-align: center;width: 75px;">Sep</th>
                                        <th style="text-align: center;width: 75px;">Okt</th>
                                        <th style="text-align: center;width: 75px;">Nov</th>
                                        <th style="text-align: center;width: 75px;">Des</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                                    </tr>
                                    @php
                                        $ca = 0;
                                    @endphp
                                    @foreach ($datamenu as $item)
                                        @if ($item->kategori == 'makanan')
                                            <tr>
                                                <td>{{ $item->menu }}</td>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    @php
                                                        $ca++;
                                                    @endphp
                                                    @if ($result[$item->menu][$i] == 0)
                                                        <td></td>
                                                    @else
                                                        <td style="text-align: right;" data-bs-toggle="modal"
                                                            data-bs-target="#detail{{ $ca }}">
                                                            {{ number_format($result[$item->menu][$i]) }}</td>
                                                    @endif
                                                @endfor
                                                <td style="text-align: right;">
                                                    <b>{{ number_format($summenu[$item->menu]) }}</b>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                                    </tr>
                                    @foreach ($datamenu as $item)
                                        @if ($item->kategori == 'minuman')
                                            <tr>
                                                <td>{{ $item->menu }}</td>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    @php
                                                        $ca++;
                                                    @endphp
                                                    @if ($result[$item->menu][$i] == 0)
                                                        <td></td>
                                                    @else
                                                        <td style="text-align: right;" data-bs-toggle="modal"
                                                            data-bs-target="#detail{{ $ca }}">
                                                            {{ number_format($result[$item->menu][$i]) }}
                                                        </td>
                                                    @endif
                                                @endfor
                                                <td style="text-align: right;">
                                                    <b>{{ number_format($summenu[$item->menu]) }}</b>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot class="table-dark">
                                    <tr>
                                        <td><b>Total</b></td>
                                        @for ($i = 1; $i <= 12; $i++)
                                            @if ($sum[$i] == 0)
                                                <td></td>
                                            @else
                                                <td style="text-align: right;">
                                                    <b>{{ number_format($sum[$i]) }}</b>
                                                </td>
                                            @endif
                                        @endfor
                                        <td style="text-align: right;">
                                            <b>{{ number_format($value) }}</b>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        @php
                            $cb = 0;
                        @endphp
                        @foreach ($datamenu as $item)
                            @for ($i = 1; $i <= 12; $i++)
                                @php
                                    $cb++;
                                @endphp
                                <div class="modal fade" id="detail{{ $cb }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ $title[$item->menu][$i] }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Menu : {{ $item->menu }}</p>
                                                <p>Total Penjualan :
                                                    {{ number_format($result[$item->menu][$i]) }}</p>
                                                <table class="table">
                                                    <th>
                                                        <tr>
                                                            <th>Tanggal Transaksi</th>
                                                            <th>Total Transaksi</th>
                                                        </tr>
                                                    </th>
                                                    <td>
                                                        @foreach ($datatransaksi as $data)
                                                            @php
                                                                $ca = date('n', strtotime($data->tanggal));
                                                            @endphp
                                                            @if ($ca == $i && $item->menu == $data->menu)
                                                                <tr>
                                                                    <td>{{ $data->tanggal }}</td>
                                                                    <td>{{ $data->total }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        @endforeach

                    @endisset
                </div>
            </div>
        </div>
    </div>
</body>

</html>
