showGraph();


function showGraph()
{
    {
        fetch(
            "https://www.cc.puv.fi/~e2101563/proman/controllers/barchart.php",
            {}
          )
            .then((response) => response.json())
            .then((data) => {
                datahandler(data)
            })
            .catch((error) => {
              console.error("Error:", error);
            });
        function datahandler(data)
        {
            console.log(data);
            var title = [];
            var taskcount = [];

            for (var i in data) {
                title.push(data[i].title);
                taskcount.push(data[i].Count);
            }

            var chartdata = {
                labels: title,
                datasets: [
                    {
                        label: 'Task amount',
                        data: taskcount,
                        borderWidth: 1,
                        borderColor: "#CB9CF2",
                        backgroundColor: "#CB9CF2",
                        color: "#CB9CF2"
                    }
                ]
            };

            var graphTarget = document.getElementById("graphCanvas");

                new Chart(graphTarget, {
                type: 'bar',
                data: chartdata,
                options : {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        };
    }
}