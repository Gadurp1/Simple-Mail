@extends('spark::layouts.app')
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<style media="screen">
#chartdiv,#chartdiv2 {
width		: 100%;
height		: 300px;
font-size	: 11px;
}
body{}
</style>
@section('content')
<home :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row">
            <div class="col-md-12">
              <div class="col-md-8">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <?php
                    foreach ($analyticsData as $item){
                        $total =+ $item['visitors'];
                    }
                    echo $total;
                    ?>
                    Page Views</div>
                    <div class="panel-body">
                      <div id="chartdiv"></div>
                    </div>
                </div>
              </div>
              <div class="col-md-4">
                <ul class="list-group" style="height:200px">
                  <li class="list-group-item"><h3>Total</h3></li>
                </ul>
              </div>
              <div class="col-md-8">
                <div class="panel panel-default">
                  <div class="panel-heading">Visitors</div>
                    <div class="panel-body">
                      <div id="chartdiv2"></div>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                      <ul class="list-group">
                      @foreach($topPages as $datas)
                        <li class="list-group-item">{{$datas['pageViews']}}</li>
                        <li class="list-group-item">{{$datas['url']}}</li>
                      @endforeach
                      </ul>
                    </div>
                </div>
              </div>

            </div>
        </div>
    </div>
</home>
<script type="text/javascript">
var chart = AmCharts.makeChart( "chartdiv", {
"type": "serial",
"theme": "light",
"dataProvider": [
  @foreach($analyticsData as $data)
  {
    "country": "{{date('D',strtotime($data['date']))}}",
    "visits": {{$data['pageViews']}}
  },
  @endforeach
],
"valueAxes": [ {
  "gridColor": "#FFFFFF",
  "gridAlpha": 0.2,
  "dashLength": 0
} ],
"gridAboveGraphs": true,
"startDuration": 1,
"graphs": [ {
  "balloonText": "[[category]]: <b>[[value]]</b>",
  "fillAlphas": 0.8,
  "lineAlpha": 0.2,
  "type": "column",
  "valueField": "visits"
} ],
"chartCursor": {
  "categoryBalloonEnabled": false,
  "cursorAlpha": 0,
  "zoomable": false
},
"categoryField": "country",
"categoryAxis": {
  "gridPosition": "start",
  "gridAlpha": 0,
  "tickPosition": "start",
  "tickLength": 20
},
"export": {
  "enabled": true
}

} );

var charts = AmCharts.makeChart( "chartdiv2", {
"type": "serial",
"theme": "light",
"dataProvider": [
  @foreach($analyticsData as $data)
  {
    "country": "{{date('D',strtotime($data['date']))}}",
    "visits": {{$data['visitors']}}
  },
  @endforeach
],
"valueAxes": [ {
  "gridColor": "#FFFFFF",
  "gridAlpha": 0.2,
  "dashLength": 0
} ],
"gridAboveGraphs": true,
"startDuration": 1,
"graphs": [ {
  "balloonText": "[[category]]: <b>[[value]]</b>",
  "fillAlphas": 0.8,
  "lineAlpha": 0.2,
  "type": "column",
  "valueField": "visits"
} ],
"chartCursor": {
  "categoryBalloonEnabled": false,
  "cursorAlpha": 0,
  "zoomable": false
},
"categoryField": "country",
"categoryAxis": {
  "gridPosition": "start",
  "gridAlpha": 0,
  "tickPosition": "start",
  "tickLength": 20
},
"export": {
  "enabled": true
}

} );
</script>
@endsection
