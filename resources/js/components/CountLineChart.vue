<script>
import { Line } from 'vue-chartjs'
import ChartDataLabels from 'chartjs-plugin-datalabels';
export default {
    extends: Line,
    props:{
        jsonData: Object,
        range: Object
    },
    watch:{
        jsonData: {
            deep: true,
            handler: function(){
                const startEpisodeIndex = this.range.start;
                const endEpisodeIndex = this.range.end;
                const dataLength = endEpisodeIndex - startEpisodeIndex + 1
                const labels = []
                for (let h = startEpisodeIndex;h < endEpisodeIndex+1;h++){
                    labels.push("エピソード"+h)
                }
                let jsonData = this.jsonData
                let sortedKeys = Object.keys(jsonData).sort(function(a, b){
                    let maxA = 0
                    for(let g = 0; g < jsonData[a].length; g++){
                        if (jsonData[a][g].count >= maxA){
                            maxA = jsonData[a][g].count
                        }
                    }
                    let maxB = 0
                    for(let h = 0; h < jsonData[b].length; h++){
                        if (jsonData[b][h].count >= maxB){
                            maxB = jsonData[b][h].count
                        }           
                    }
                    return maxB - maxA
                })
                console.log(Object.keys(this.jsonData))
                console.log(sortedKeys)
                const datasets = []
                let i = 0
                let isHidden = false
                //オブジェクトのキーを取得してループ
                for(let j of sortedKeys) {
                    const data = Array(dataLength)
                    for(let k = 0; k < this.jsonData[j].length; k++){
                        for(let l = startEpisodeIndex; l < endEpisodeIndex+1; l++){
                            if (this.jsonData[j][k].episode_id == l){
                                data[k] = this.jsonData[j][k].count
                                break
                            }
                        }
                    }
                    if (i > 3){
                        isHidden = true
                    }
                    datasets[i] = {
                        label: this.jsonData[j][0].boys_info[0].name + 'と' + this.jsonData[j][0].girls_info[0].name,
                        data: data,
                        borderColor: `rgb(${((i + 1) * 100)%255}, ${((i + 1) * 200)%255}, ${((i + 1) * 300)%255}`,
                        fill: false,
                        lineTension: 0.1,
                        hidden: isHidden
                    }
                    i ++ 
                }
                this.addPlugin(ChartDataLabels)
                this.addPlugin({
                    beforeRender: function (chart) {
                    if (chart.config.options.showAllTooltips) {
                        chart.pluginTooltips = [];
                        chart.config.data.datasets.forEach(function (dataset, i) {
                        chart.getDatasetMeta(i).data.forEach(function (sector, j) {
                            chart.pluginTooltips.push(new Chart.Tooltip({
                            _chart: chart.chart,
                            _chartInstance: chart,
                            _data: chart.data,
                            _options: chart.options.tooltips,
                            _active: [sector]
                            }, chart));
                        });
                        });
                        chart.options.tooltips.enabled = false;
                    }
                    },
                    afterDraw: function (chart, easing) {
                    if (chart.config.options.showAllTooltips) {
                        if (!chart.allTooltipsOnce) {
                        if (easing !== 1)
                        return;
                        chart.allTooltipsOnce = true;
                        }
                        chart.options.tooltips.enabled = true;
                        let index = 0
                        Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
                            if (index%6 === 1 && index < 21){
                                tooltip.initialize();
                                tooltip.update();
                                tooltip.transition(easing).draw();
                            }
                            index ++
                        });
                        chart.options.tooltips.enabled = false;
                    }
                    }
                }),
                this.renderChart(
                    {
                        "labels": labels,
                        "datasets": datasets
                    },
                    {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMax: 20,
                                    suggestedMin: 0,
                                }
                            }]
                        },
                        plugins: {
                            datalabels: {
                                formatter: function(value, context) {
                                    if(context.datasetIndex % 4 + 1 === context.dataIndex){
                                        return context.chart.data.datasets[context.datasetIndex].label;
                                    }else{
                                        return ''
                                    }
                                    
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        showAllTooltips: true,
                        legend:{
                            fontSize: 100
                        }
                    }
                )
            }
        }
    }
}
</script>