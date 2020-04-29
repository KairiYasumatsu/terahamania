<script>
import { Line } from 'vue-chartjs'
export default {
    extends: Line,
    props:{
        jsonData: Object
    },
    watch:{
        jsonData: {
            deep: true,
            handler: function(){
                // console.log('hoge',this.jsonData)
                const startEpisodeIndex = 36;
                const endEpisodeIndex = 40;
                const dataLength = endEpisodeIndex - startEpisodeIndex + 1
                const labels = []
                for (let h = startEpisodeIndex;h < endEpisodeIndex+1;h++){
                    labels.push("エピソード"+h)
                }
                const datasets = []
                let i = 0
                for(let j of Object.keys(this.jsonData)) {
                    const data = Array(dataLength)
                    // console.log('wow', this.jsonData[j])
                    for(let k = 0; k < this.jsonData[j].length; k++){
                        for(let l = startEpisodeIndex; l < endEpisodeIndex+1; l++){
                            // console.log("poke", this.jsonData[j][k].episode_id)
                            if (this.jsonData[j][k].episode_id == l){
                                // console.log('fuga', this.jsonData[j][k].count)
                                data[k] = this.jsonData[j][k].count
                                break
                            }
                        }
                    }
                    datasets[i] = {
                        label: this.jsonData[j][0].boys_info[0].name + 'と' + this.jsonData[j][0].girls_info[0].name,
                        data: data,
                        borderColor: `rgb(${((i + 1) * 100)%255}, ${((i + 1) * 200)%255}, ${((i + 1) * 300)%255}`,
                        fill: false,
                        lineTension: 0.1
                    }
                    i ++ 
                }
                console.log(datasets)
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
                        }
                    }
                )
            }
        }
    }
}
</script>