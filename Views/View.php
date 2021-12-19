<?php
    class myView{
        private $data;

        function setData($data){
            $this->data = $data;
        }

        function showChart(){
            echo
            "
            <br><br>
                <script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
                <script type=\"text/javascript\">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);


                function drawChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Taryfa');
                    data.addColumn('number', 'Ilość');
                    data.addRows([";
                      foreach($this->data as $d){
                        echo "['".$d[0]."',".$d[1]."]";
                        if(array_search($d,$this->data)!=sizeof($this->data)-1)
                            echo ",";
                      }
                    echo "]);
                    var options = {'title':'',
                                    'width':600,
                                    'height':600,
                                    is3D: true,
                                    colors:['#d1ae2b','#b38849','#d8a35c','#636466','#a09f9f','#31536e','#4c7ea4','#73bfe5','#88d6f8'],
                                };
 
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                    chart.draw(data,options);
                }
                </script>
                <div id=\"chart_div\" style='transform: translateX(20%);'></div>
            ";
        }
    }
?>