async function chartAbsorbance(){
    var data = 'device0003';
    await getdata(data);
    var ctx = document.getElementById('Absorbance').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'line',
    data: { 
    labels: jsarray, 
    datasets: [{
        label: 'Kurva Absorbansi', 
        data: jsdata,              
        backgroundColor: 'rgba( 255,99,132,5)',
        borderColor: 'rgba(255, 159, 64, 1)',
        borderWidth: 3,
        fill:false
    }]
    },
    options: {
    scales: {
        yAxes: [{
        ticks: {
        beginAtZero: true
        }
        }]
    }
    }
    });
}

async function getdata(data){
    // const url = "api/chartdata.php"
    const url = "api/graphdata.php?deviceid="+data;
    // const url = "api/graphdata.php?device=device0003";
    console.log(url);
    const response = await fetch(url);
    const jsondata = await response.json();

    jsarray = [];
    jsdata = [];

    for (let i= 0; i < Object.keys(jsondata).length; i++) {
            jsarray.push(jsondata[i]['dates']);
            jsdata.push(jsondata[i]['adso']);
            // console.log(jsarray);
    }

    console.log(jsarray);
    console.log(jsdata);
}