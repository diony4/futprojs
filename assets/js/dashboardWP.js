var ventamesesWP = [];

window.onload = function () {
  $.ajax({
    url: "https://futprojs.com/Inicio/ventasmes",
    type: "GET",
    success: function (res) {
     
      for (let x of JSON.parse(res)) {
        
        let i = {
          label:obtenerMes(x.mes)+"-"+String(x.anio),
          y: Number(x.monto),
        };

        ventamesesWP.push(i);
      }
      
      var chartVentaMeses = new CanvasJS.Chart("chartContainerVentaMesesWP", {
        title: {
          text: "VENTAS DE LOS ULTIMOS 12 MESES",
        },
        data: [
          {
            // Change type to "doughnut", "line", "splineArea", etc.
            type: "column",
            dataPoints: ventamesesWP,
          },
        ],
      });
      chartVentaMeses.render();
    },
  });
  

};


function obtenerMes(mes){
   
    moment.locale('es'); 
    let m = moment(String(mes)).format('MMMM')
  
    return m;
}
