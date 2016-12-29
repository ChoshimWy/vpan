<?php
function select(){
	try{
		header( "Content-type:text/html;charset=utf-8" );
		$db_host = 'localhost';
		$db_name = 'vpan';
		$db_user = 'root';
		$db_pwd = 'xycj_1125_yun';

//面向过程方式的连接方式
		$db_connect = new mysqli($db_host,$db_user,$db_pwd,$db_name);
		$sql = "SELECT * FROM wp_productmain";

		$re = $db_connect->query($sql);
		//遍历数据
		while ($row=mysqli_fetch_assoc($re)){

			return $row['ProductCode'];
		}

		$re->close();
		$db_connect->close();


	} catch(Exception $e){
	}
}

function send_post($url,$data){

    try{
        $postData = http_build_query($data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postData,
                'timeout' => 15 * 60
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        return $result;
    }catch (Exception $e){

    }

}

$post_data1 = array(
	'SIGNATURE' => '04ed97b5-28f8-4ab8-a333-f0fa9227819a',
	'ADAPTER' => 'MT2007',
	'MODE' => 'JQ',
	'PAGE' => '1',
	'ROWS' => '150',
	'KTYPE' => 'E',
	'WAREID' => select()
);


$url1 = 'http://59.51.65.127:9081/MIS-Adapter/marketAdapter.action';

$res1 = json_encode(send_post($url1,$post_data1));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<title>行情</title>

	<style>html { overflow: hidden; }</style>


	<script type="text/javascript" src="style/js/echarts.js"></script>


</head>
<body>

<div id="main" style="width: 100%;height: 350px;"></div>

<!--日K线-->
<script type="text/javascript">
	var dat = <?php echo $res1; ?>;
	//
	var s = JSON.parse(dat);
	//截取数据段
	s.DATAS.shift();
	//	alert(s.DATAS);


	var myChart = echarts.init(document.getElementById('main'));

	var rawData = s.DATAS;

	function calculateMA(dayCount, data) {
		var result = [];
		for (var i = 0, len = data.length; i < len; i++) {
			if (i < dayCount) {
				result.push('-');
				continue;
			}
			var sum = 0;
			for (var j = 0; j<dayCount; j++) {
				sum += data[i - j][1];
			}
			result.push(sum / dayCount);
		}
		return result;
	}



	var dates = rawData.map(function (item) {
		return item[1];
	});

	var data = rawData.map(function (item) {
		return [+item[2], +item[3], +item[5], +item[15]];
	});
	var option = {
		backgroundColor: '#21202D',
		legend: {
			data: ['日K', 'MA5', 'MA10', 'MA20', 'MA30'],
			inactiveColor: '#777',
			textStyle: {
				color: '#fff'
			}
		},
		tooltip: {
			trigger: 'axis',
			axisPointer: {
				animation: false,
				lineStyle: {
					color: '#376df4',
					width: 2,
					opacity: 1
				}
			}
		},
		xAxis: {
			type: 'category',
			data: dates,
			axisLine: { lineStyle: { color: '#8392A5' } }
		},
		yAxis: {
			scale: true,
			axisLine: { lineStyle: { color: '#8392A5' } },
			splitLine: { show: false }
		},
		dataZoom: [{
			textStyle: {
				color: '#8392A5'
			},
			handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
			handleSize: '80%',
			dataBackground: {
				areaStyle: {
					color: '#8392A5'
				},
				lineStyle: {
					opacity: 0.8,
					color: '#8392A5'
				}
			},
			handleStyle: {
				color: '#fff',
				shadowBlur: 3,
				shadowColor: 'rgba(0, 0, 0, 0.6)',
				shadowOffsetX: 2,
				shadowOffsetY: 2
			}
		}, {
			type: 'inside'
		}],
		animation: false,
		series: [
			{
				type: 'candlestick',
				name: '日K',
				data: data,
				itemStyle: {
					normal: {
						color: '#FD1050',
						color0: '#0CF49B',
						borderColor: '#FD1050',
						borderColor0: '#0CF49B'
					}
				}
			},
			{
				name: 'MA5',
				type: 'line',
				data: calculateMA(5, data),
				smooth: true,
				showSymbol: false,
				lineStyle: {
					normal: {
						width: 1
					}
				}
			},
			{
				name: 'MA10',
				type: 'line',
				data: calculateMA(10, data),
				smooth: true,
				showSymbol: false,
				lineStyle: {
					normal: {
						width: 1
					}
				}
			},
			{
				name: 'MA20',
				type: 'line',
				data: calculateMA(20, data),
				smooth: true,
				showSymbol: false,
				lineStyle: {
					normal: {
						width: 1
					}
				}
			},
			{
				name: 'MA30',
				type: 'line',
				data: calculateMA(30, data),
				smooth: true,
				showSymbol: false,
				lineStyle: {
					normal: {
						width: 1
					}
				}
			}
		]
	};

	// 使用刚指定的配置项和数据显示图表。
	myChart.setOption(option);
	window.onresize = myChart.resize;
</script>
</body>
</html>

	 
