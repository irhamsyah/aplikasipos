<div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          @if(count($transharian)>0)
          @foreach($transharian as $value)
          <h5>Rp.{{number_format($value->total_sales,0,',','.')}}</h5>
          @endforeach
          @else 
          <h3>0</h3>
          @endif
        </div>
        <div class="w3-clear"></div>
        <h5>Transaksi Hari ini</h5>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          @if(count($transbulanini)>0)
          @foreach($transbulanini as $value)
          <h5>Rp.{{number_format($value->total_sales,0,',','.')}}</h5>
          @endforeach
          @else 
          <h3>0</h3>
          @endif
        </div>
        <div class="w3-clear"></div>
        <h5>Transaksi Bulan ini</h5>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          @if(count($transbulanlalu)>0)
          @foreach($transbulanlalu as $value)
          <h5>Rp.{{number_format($value->total_sales,0,',','.')}}</h5>
          @endforeach
          @else 
          <h3>0</h3>
          @endif
        </div>
        <div class="w3-clear"></div>
        <h5>Transaksi Bulan lalu</h5>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          @if(count($transsatutahun)>0)
          @foreach($transsatutahun as $value)
          <h5>Rp.{{number_format($value->total_sales,0,',','.')}}</h5>
          @endforeach
          @else 
          <h3>0</h3>
          @endif
        </div>
        <div class="w3-clear"></div>
        <h5>Transaksi Tahun ini</h5>
      </div>
    </div>
  </div>
