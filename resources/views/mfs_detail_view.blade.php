<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>Detail Form</div>
    <div class='panel-body'>      
        <div class='table-responsive'>
            <table id='table-detail' class='table table-striped'>
                <tbody>
                    <tr>
                        <td>Nama Pasien</td>
                        <td>{{$row->nama_pasien}}</td>
                    </tr>
                    <tr>
                        <td>Riwayat Jatuh</td>
                        <td>{{$row->skala_riwayat_jatuh}}</td>
                    </tr>
                    <tr>
                        <td>Diagnosis Skunder</td>
                        <td>{{$row->skala_diagnosis_sekunder}}</td>
                    </tr>
                    <tr>
                        <td>Alat Bantu Pergerakan</td>
                        <td>{{$row->skala_alat_bantu_pergerakan}}</td>
                    </tr>
                    <tr>
                        <td>Terapi Intra Vena</td>
                        <td>{{$row->skala_terapi_intra_vena}}</td>
                    </tr>
                    <tr>
                        <td>Gait</td>
                        <td>{{$row->skala_gait}}</td>
                    </tr>
                    <tr>
                        <td>Status Mental</td>
                        <td>{{$row->skala_status_mental}}</td>
                    </tr>
                    <tr>
                        <td>Tingkat Risiko</td>
                        <?php if($row->mfs <= 24): ?>
                          <td><b><font color="green">TIDAK BERISIKO JATUH</font></b></td>
                        <?php elseif($row->mfs <= 50): ?>
                          <td><b><font color="orange">RISIKO JATUH RENDAH</font></b></td>
                        <?php elseif($row->mfs > 51): ?>
                          <td><b><font color="red">RISIKO JATUH TINGGI</font></b></td>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td>Tindakan</td>
                        <?php if($row->mfs <= 24): ?>
                          <td>MINIMAL CARE</td>
                        <?php elseif($row->mfs <= 50): ?>
                          <td>INTERVENSI PENCEGAHAN JATUH STANDAR</td>
                        <?php elseif($row->mfs > 51): ?>
                          <td>INTERVENSI PENCEGAHAN JATUH RISIKO TINGGI</td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
        </div>
      </form>
    </div>
  </div>
@endsection