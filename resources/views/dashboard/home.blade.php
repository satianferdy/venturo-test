@extends('layouts.app')

@section('title', 'Venturo')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Venturo</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">Menu - Laporan Penjualan Tahunan</h2>
            <p class="section-lead">
                You can manage all transaksi, such as editing, deleting and more.
            </p>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Data Penjualan</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-right">
                                <div class="col-5 pb-2">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="">
                                            <select name="tahun" class="form-select" id="">
                                                <option selected disabled>Pilih Tahun Penjualan</option>
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

                            <div class="clearfix mb-3"></div>

                            <div class="">
                                @isset($data)
                                    <div class="table table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="">
                                                    <th rowspan="2"
                                                        style="text-align:center;vertical-align: middle;width: 250px;">Menu
                                                    </th>
                                                    <th colspan="12" style="text-align: center;">Periode Pada
                                                        {{ $tahun }}
                                                    </th>
                                                    <th rowspan="2"
                                                        style="text-align:center;vertical-align: middle;width:75px">
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
                                                    <td class="table-secondary" colspan="14"><b>Makanan</b>
                                                    </td>
                                                </tr>
                                                @foreach ($datamenu as $dm)
                                                    @if ($dm->kategori == 'makanan')
                                                        <tr>
                                                            <td>{{ $dm->menu }}</td>
                                                            @for ($i = 1; $i <= 12; $i++)
                                                                @if ($result[$dm->menu][$i] == 0)
                                                                    <td></td>
                                                                @else
                                                                    <td>{{ number_format($result[$dm->menu][$i]) }}</td>
                                                                @endif
                                                            @endfor
                                                            <td>{{ number_format($summenu[$dm->menu]) }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                <tr>
                                                    <td class="table-secondary" colspan="14"><b>Minuman</b>
                                                    </td>
                                                </tr>
                                                @foreach ($datamenu as $dm)
                                                    @if ($dm->kategori == 'minuman')
                                                        <tr>
                                                            <td>{{ $dm->menu }}</td>
                                                            @for ($i = 1; $i <= 12; $i++)
                                                                @if ($result[$dm->menu][$i] == 0)
                                                                    <td></td>
                                                                @else
                                                                    <td>{{ number_format($result[$dm->menu][$i]) }}</td>
                                                                @endif
                                                            @endfor
                                                            <td>{{ number_format($summenu[$dm->menu]) }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot class="table-dark">
                                                <tr>
                                                    <td>Total</td>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <td>{{ number_format($sum[$i]) }}</td>
                                                    @endfor
                                                    <td>{{ number_format($value) }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('sidebar')
