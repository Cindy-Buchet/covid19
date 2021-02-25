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
        var chart2 = am4core.create("chartdiv2", am4charts.XYChart);
            chart2.language.locale = am4lang_fr_FR;
            chart2.numberFormatter.language = new am4core.Language();
            chart2.numberFormatter.language.locale = am4lang_fr_FR;
            chart2.dateFormatter.language = new am4core.Language();
            chart2.dateFormatter.language.locale = am4lang_fr_FR;

        // Add data
        chart2.data = <?php echo json_encode($tableau); ?>

        // Create category axis
        var categoryAxis2 = chart2.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis2.dataFields.category = "dateNormal";
            categoryAxis2.renderer.opposite = true;

        // Create value axis
        var valueAxis2 = chart2.yAxes.push(new am4charts.ValueAxis());
            valueAxis2.renderer.inversed = false;
            valueAxis2.renderer.minLabelPosition = 0.01;

        // Create series
        var series21 = chart2.series.push(new am4charts.LineSeries());
            series21.dataFields.valueY = "casNouveau";
            series21.dataFields.categoryX = "dateNormal";
            series21.name = "nouveaux cas";
            series21.strokeWidth = 2;
            series21.bullets.push(new am4charts.CircleBullet());
            series21.tooltipText = "{name}: {valueY}";
            series21.legendSettings.valueText = "{valueY}";
            series21.visible  = false;

        var series22 = chart2.series.push(new am4charts.LineSeries());
            series22.dataFields.valueY = "mortsNouveau";
            series22.dataFields.categoryX = "dateNormal";
            series22.name = 'nouveaux morts';
            series22.strokeWidth = 2;
            series22.bullets.push(new am4charts.CircleBullet());
            series22.tooltipText = "{name}: {valueY}";
            series22.legendSettings.valueText = "{valueY}";

        var series23 = chart2.series.push(new am4charts.LineSeries());
            series23.dataFields.valueY = "guerrisNouveau";
            series23.dataFields.categoryX = "dateNormal";
            series23.name = 'nouveaux guéris';
            series23.strokeWidth = 2;
            series23.bullets.push(new am4charts.CircleBullet());
            series23.tooltipText = "{name}: {valueY}";
            series23.legendSettings.valueText = "{valueY}";


        chart2.cursor = new am4charts.XYCursor();
        chart2.cursor.xAxis = dateAxis2;

        var scrollbarX2 = new am4core.Scrollbar();
            scrollbarX2.marginBottom = 20;
            chart2.scrollbarX = scrollbarX2;


        var dateAxis2 = chart2.xAxes.push(new am4charts.DateAxis());
            dateAxis2.renderer.grid.template.location = 0;
            dateAxis2.minZoomCount = 5;

        
        // Add legend
        chart2.legend = new am4charts.Legend();


    }); // end am4core.ready()
</script>
