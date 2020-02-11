chartadsorbansi();
chartVoltase();
chartIntensitas();
chartTransmitansi();
async function chartIntensitas() {
        await getdata();
        var ctx = document.getElementById('Intensitas').getContext('2d');
        var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                        labels: jsarray,
                        datasets: [{
                                label: 'Kurva Intensitas',
                                data: jsdata,
                                backgroundColor: 'rgba( 255,99,132,5)',
                                borderColor: 'rgba(255, 159, 64, 1)',
                                borderWidth: 3,
                                fill: false
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
async function chartVoltase() {
        await getdata();
        var ctx = document.getElementById('Voltase').getContext('2d');
        var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                        labels: jsarray,
                        datasets: [{
                                label: 'Kurva Voltase',
                                data: jsdata,
                                backgroundColor: 'rgba( 255,99,132,5)',
                                borderColor: 'rgba(255, 159, 64, 1)',
                                borderWidth: 3,
                                fill: false
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
async function chartTransmitansi() {
        await getdata();
        var ctx = document.getElementById('Transmitansi').getContext('2d');
        var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                        labels: jsarray,
                        datasets: [{
                                label: 'Kurva Transmitansi',
                                data: jsdata,
                                backgroundColor: 'rgba( 255,99,132,5)',
                                borderColor: 'rgba(255, 159, 64, 1)',
                                borderWidth: 3,
                                fill: false
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
async function chartadsorbansi() {
        await getdata();
        var ctx = document.getElementById('Adsorbansi').getContext('2d');
        var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                        labels: jsarray,
                        datasets: [{
                                label: 'Kurva Adsorbansi',
                                data: jsdata,
                                backgroundColor: 'rgba( 255,99,132,5)',
                                borderColor: 'rgba(255, 159, 64, 1)',
                                borderWidth: 3,
                                fill: false
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
async function getdata() {
        const url = "api/chartdata.php"
        const response = await fetch(url);
        const jsondata = await response.json();

        jsarray = [];
        jsdata = [];

        for (let i = 0; i < Object.keys(jsondata).length; i++) {
                jsarray.push(jsondata[i]['dates']);
                jsdata.push(jsondata[i]['volt']);
                // console.log(jsarray);
        }

        console.log(jsarray);
        console.log(jsdata);
}