<!-- Resources -->
<?php 
    require_once('elements/scripts.js'); 
?>

<!-- Chart code -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);
            chart.language.locale = am4lang_fr_FR;
            chart.numberFormatter.language = new am4core.Language();
            chart.numberFormatter.language.locale = am4lang_fr_FR;
            chart.dateFormatter.language = new am4core.Language();
            chart.dateFormatter.language.locale = am4lang_fr_FR;

        // Add data
        chart.data = <?php echo json_encode($tableau); ?>

        // Create category axis
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "date";
            categoryAxis.renderer.opposite = true;

        // Create value axis
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.inversed = false;
            valueAxis.renderer.minLabelPosition = 0.01;

        // Create series
        var series1 = chart.series.push(new am4charts.LineSeries());
            series1.dataFields.valueY = "cas";
            series1.dataFields.categoryX = "date";
            series1.name = "cas";
            series1.strokeWidth = 2;
            series1.bullets.push(new am4charts.CircleBullet());
            series1.tooltipText = "{name}: {valueY}";
            series1.legendSettings.valueText = "{valueY}";
            series1.visible  = false;

        var series2 = chart.series.push(new am4charts.LineSeries());
            series2.dataFields.valueY = "morts";
            series2.dataFields.categoryX = "date";
            series2.name = 'morts';
            series2.strokeWidth = 2;
            series2.bullets.push(new am4charts.CircleBullet());
            series2.tooltipText = "{name}: {valueY}";
            series2.legendSettings.valueText = "{valueY}";

        var series3 = chart.series.push(new am4charts.LineSeries());
            series3.dataFields.valueY = "guéris";
            series3.dataFields.categoryX = "date";
            series3.name = 'guéris';
            series3.strokeWidth = 2;
            series3.bullets.push(new am4charts.CircleBullet());
            series3.tooltipText = "{name}: {valueY}";
            series3.legendSettings.valueText = "{valueY}";


        chart.cursor = new am4charts.XYCursor();
        chart.cursor.xAxis = dateAxis;

        var scrollbarX = new am4core.Scrollbar();
            scrollbarX.marginBottom = 20;
            chart.scrollbarX = scrollbarX;


        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.grid.template.location = 0;
            dateAxis.minZoomCount = 5;
        
        // Add legend
        chart.legend = new am4charts.Legend();


    }); // end am4core.ready()
</script>
