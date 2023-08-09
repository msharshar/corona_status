$(document).ready(function(){
    var number_response;
    var date_response;

    var country_name = $('#country_name').val();
    var chart_type = $('#chart_type').val();
    var xmlhttp;
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 & xmlhttp.status == 200){

            number_response = xmlhttp.responseText
            number_response = number_response.split('.');
            number_response = number_response.map(Number);
            number_response.splice(number_response.length - 1);
            console.log(number_response);

            
        }
    }

    xmlhttp.open("GET", "data.php?chart_type="+chart_type+"&country="+country_name, true);
    xmlhttp.send();
    //================================================================================================
    var xmlhttp2;
    xmlhttp2 = new XMLHttpRequest();

    xmlhttp2.onreadystatechange = function(){
        if(xmlhttp2.readyState == 4 & xmlhttp2.status == 200){

            date_response = xmlhttp2.responseText
            date_response = date_response.split('.');
            date_response.splice(date_response.length - 1);
            console.log(date_response);

            
        }
    }

    xmlhttp2.open("GET", "data.php?date&country="+country_name, true);
    xmlhttp2.send();

    setTimeout(function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: date_response,
                datasets: [{
                    label: 'Number of '+chart_type+' cases',
                    data: number_response,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(231, 76, 60, 1)'
                        // 'rgba(255, 99, 132, 1)',
                        // 'rgba(54, 162, 235, 1)',
                        // 'rgba(255, 206, 86, 1)',
                        // 'rgba(75, 192, 192, 1)',
                        // 'rgba(153, 102, 255, 1)',
                        // 'rgba(255, 159, 64, 1)'
                    ],
                }]
            }
        });
    }, 500);

});