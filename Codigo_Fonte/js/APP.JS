
$('document').ready(function () {

  $.ajax({
      type: "POST",
      url: "chart.php",
      dataType: "json",
      success: function (data) {

          var nomearray = [];
          var qtd_alunossarray = [];

          for (var i = 0; i < data.length; i++) {

              nomearray.push(data[i].nome);
              qtd_alunossarray.push(data[i].qtd_alunos);
              

          }

          grafico(nomearray,qtd_alunossarray);

      }
  });

})

function grafico(nome,qtd_alunos) {


  var ctx = document.getElementById('myChart').getContext('2d');

  var chart = new Chart(ctx, {

      type: 'bar',
      data: {
           
          labels:nome, qtd_alunos,  
          
          datasets: [{
              label: 'Gráfico Rosane',
              label: 'Quantidade de Alunos',
              backgroundColor: ['green', 'green', 'green', 'green','green','green', 'green', 'green','green','green'],
              borderColor: 'rgb(255, 99, 132)',
              data: qtd_alunos
          }]
      },

      options: {
          scales: {
              xAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
}