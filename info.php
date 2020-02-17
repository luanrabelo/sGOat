<?php
$LimitSpecies = 15;
include('conection.php');
$Id_Project 	= $_GET["id"];

//Chart
$Projetos	  		= "SELECT * FROM projetos WHERE Project_Name = '".$Id_Project."'";
$qry 		  		= $mysqli->query($Projetos);
$Total_Seq	  		= mysqli_num_rows($qry);

$Blasted			= "SELECT * FROM projetos WHERE Blast = 'Hits' AND Project_Name = '".$Id_Project."'";
$qry_blast  		= $mysqli->query($Blasted);
$T_Blast			= mysqli_num_rows($qry_blast);
$Qtde_Hits 			= ($T_Blast*100)/$Total_Seq;

$NotBlasted			= "SELECT * FROM projetos WHERE Blast = 'No Hits' AND Project_Name = '".$Id_Project."'";
$qry_nblast			= $mysqli->query($NotBlasted);
$T_nBlast			= mysqli_num_rows($qry_nblast);
$Qtde_noHits		= ($T_nBlast*100)/$Total_Seq;

$Annoted	        = "SELECT * FROM projetos WHERE GO != '-' AND Project_Name = '".$Id_Project."'";
$qry_annoted        = $mysqli->query($Annoted);
$T_nAnnoted         = mysqli_num_rows($qry_annoted);
$Qtde_Annoted       = ($T_nAnnoted*100)/$Total_Seq;



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sem título</title>	
<style>
#chart {
  	max-width: 50%;
	height: 500px;
 	margin: 100px auto;
}	
</style>	
</head>	
<body>
<?php
$query 		= "SELECT * FROM newprojects WHERE `Id_Project` = $Id_Project";
$result 	= $mysqli->query($query);
$NamePro	= mysqli_fetch_assoc($result);	
?>
<div class="w-75" style="margin: 0 auto;">	
<div class="card-header bg-dark text-white text-center" style="font-family: monoscape;">Details of <b><?php echo($NamePro["ProjectName"]);?></b></div>
<div class="card-body">
<h5 class="card-title"></h5>
<p class="card-text"></p>
<a href="#" class="btn btn-primary"></a>
</div>
<div class="card-footer text-muted"></div>	
</div>
	
<nav>
<div class="nav nav-tabs" id="nav-tab" role="tablist">
<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Graphics</a>
</div>
</nav>

<div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<table class="table table-striped table-hover table-sm">
<caption style="padding-left: 25px;">List</caption>	
<tbody>
<tr class="bg-dark text-white text-center">
<td><b>Description</b></td>
<td><b>Total</b></td>
<td><b>Download</b></td>	 
</tr>
<?php
$Projetos	  	= ("SELECT Description, Count(*) FROM projetos WHERE Project_Name = $Id_Project AND Description != '-' GROUP BY Description HAVING Count(*) >= 50 ORDER BY Count(*) DESC");
$qry 			= mysqli_query($mysqli, $Projetos);
$result = $mysqli->query($Projetos);
while ($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo mb_strimwidth($row["Description"], 0, 150, "...");?></td>
<td class="text-center"><?php echo $row["Count(*)"];?></td>
<td class="text-center">Download</td>		
</tr>
<?php };?>
	
<tr class="bg-dark">
<td></td>
<td></td>
<td></td>	
</tr>	
</tbody>
</table>
</div>			
<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
	
</div>
	
<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
<?php
$Function	  	= ("SELECT GO_Names FROM projetos WHERE Project_Name = $Id_Project");
$qry 			= mysqli_query($mysqli, $Function);
$result = $mysqli->query($Function);
while ($rowF = $result->fetch_assoc()) {
$Celular 		=  substr_count($rowF["GO_Names"], "C:");	
$TotalC 		+= $Celular;
$Molecular 		=  substr_count($rowF["GO_Names"], "F:");	
$TotalM 		+= $Molecular;
$Biological 	=  substr_count($rowF["GO_Names"], "P:");	
$TotalP 		+= $Biological;
	
$qtRNA	 		=  substr_count($row["Description"], "tRNA");	
$tRNA			+= $qtRNA;
$qmRNA	 		=  substr_count($row["Description"], "mRNA");	
$mRNA			+= $qmRNA;	
} 
//echo("Cellular Component: ".$TotalC."<br>");	
//echo("Molecular Function: ".$TotalM."<br>");
//echo("Biological Process: ".$TotalP."<br>");
//echo("tRNA: ".$tRNA."<br>");
//echo("mRNA: ".$mRNA."<br>");	
?>
<div id="html">
<div id="chart">
<apexchart type=pie width=100% :options="chartOptions" :series="series" />
</div>
</div>
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-apexcharts"></script>
	

<script>
new Vue({
el: '#chart',
components: {
apexchart: VueApexCharts,
},
data: {
series: [<?php echo($TotalC);?>, <?php echo($TotalM);?>, <?php echo($TotalP);?>],
chartOptions: {
labels: ['Cellular Component', 'Molecular Function', 'Biological Process'],
fontColor: 'black',
defaultFontSize: 50,	
responsive: [{
breakpoint: 10,
options: {
chart: {
width: 500
},
legend: {
                position: 'bottom'
              }
            }
          }]
        },
	title: {
              text: 'Species Distribution',
              align: 'center',
              floating: true,
			  style: {
              fontSize: '30px',
              colors: ['#000000']
            }
          },
      },

    })
</script>
<br><br><br><br><br><br><br><br><br><br><br><br>
<div id="SpeciesDistribution" style="margin: 0 auto"><apexchart type=bar width=100% height=auto :options="chartOptions" :series="series" /></div>	
<script>
new Vue({
el: '#SpeciesDistribution',
components: {
        apexchart: VueApexCharts,
      },
      data: {
        series: [{
          data: [
<?php	
$Projetos	  	= ("SELECT organism, Count(*) FROM projetos WHERE Project_Name = $Id_Project AND organism != '-' GROUP BY organism HAVING Count(*) > 1 ORDER BY Count(*) DESC LIMIT 10");
$qry 			= mysqli_query($mysqli, $Projetos);
$result = $mysqli->query($Projetos);
while ($row = $result->fetch_assoc()) {
echo ($row["Count(*)"].", ");
}	
?>
]
        }],
        chartOptions: {
          plotOptions: {
            bar: {
              barHeight: '100%',
              distributed: true,
              horizontal: true,
              dataLabels: {
                position: 'bottom'
              },
            }
          },
          colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
            '#f48024', '#69d2e7'
          ],
          dataLabels: {
            enabled: true,
            textAnchor: 'start',
            style: {
              colors: ['#404040']
            },
            formatter: function (val, opt) {
              return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
            },
            offsetX: 0,
            dropShadow: {
              enabled: true
            }
          },

          stroke: {
            width: 1,
            colors: ['#fff']
          },
xaxis: {
categories: 
<?php
echo("[");	
$Projetos	  	= ("SELECT organism, Count(*) FROM projetos WHERE Project_Name = $Id_Project AND organism != '-' GROUP BY organism HAVING Count(*) > 1 ORDER BY Count(*) DESC LIMIT 15");
$qry 			= mysqli_query($mysqli, $Projetos);
$result = $mysqli->query($Projetos);
while ($row = $result->fetch_assoc()) {
echo ("'".$row["organism"]."', ");
}
echo("'Others'],");	
?>
},
          yaxis: {
            labels: {
              show: false
            }
          },
          title: {
              text: 'Species Distribution',
              align: 'center',
              floating: true,
			  style: {
              fontSize: '30px',
              colors: ['#000000']
            }
          },
          subtitle: {
              text: 'Top 15 BLAST Hits',
              align: 'center',
			  style: {
              fontSize: '15px',
              colors: ['#000000']
            }
          },
          tooltip: {
            theme: 'dark',
            x: {
              show: false
            },
            y: {
              title: {
                formatter: function () {
                  return ''
                }
              }
            }
          }
        }
      }
    })
</script>		
</div>
</div>	
<br><br>
<div style="margin: 0 auto">	
<script src="//d3js.org/d3.v3.min.js"></script>
<script>

var width = 1000,
    height = 1000;

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height);

svg.append("circle")
    .attr("cx", 600)
    .attr("cy", 300)
    .attr("r", 300)
    .style("fill", "brown")
    .style("fill-opacity", ".5");

svg.append("circle")
    .attr("cx", 750)
    .attr("cy", 300)
    .attr("r", 300)
    .style("fill", "steelblue")
    .style("fill-opacity", ".5");
	

</script>
</div>	

		
</body>
</html>
