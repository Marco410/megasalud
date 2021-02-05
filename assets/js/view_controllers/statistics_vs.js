Pace.on('done', function(){
	init();
});

function init(){

    $.ajax({
            url:  base_url + 'megasalud/StatisticsController/getSexoP',
            type:  'get',
            success: function(respuesta){

                if(respuesta){
                    var res = JSON.parse(respuesta);
                 var cSexo = document.getElementById("chartSexo");
                     var chartS = new Chart(cSexo,{
                       type: "pie",
                        data:{
                            labels: ["Masculino","Femenino"],
                            datasets:[{
                                label: "# pacientes",
                                data: [res.hombres,res.mujeres],
                                backgroundColor:[
                                    'rgba(32, 174, 255)',
                                    'rgba(255, 78, 135)',
                                ],
                                borderwidth:1
                            }]

                        },
                        options:{
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });

                }
                else{
                }
            }
        }); 
    $.ajax({
            url:  base_url + 'megasalud/StatisticsController/getEdad',
            type:  'get',
            success: function(respuesta){

                if(respuesta){
                    var res = JSON.parse(respuesta);
                 var cEdad = document.getElementById("chartEdad");
                     var chartS = new Chart(cEdad,{
                       type: "bar",
                        data:{
                            labels: ["13-20","21-25","26-30","31-35","36-40","41-45","46-50","51-55","56-60","61-65"],
                            datasets:[{
                                label: "Edades",
                                data: [res.e1320,res.e2125,res.e2630,res.e3135,res.e3640,res.e4145,res.e4650,res.e5155,res.e5660,res.e6165],
                                backgroundColor:[
                                    '#2CCBD7',
                                    '#2CC1D7',
                                    '#2CB9D7','#35D8FB',
                                    '#00D2FF','#00A8FF',
                                    '#0090DA','#0072DA',
                                    '#005BDA','#004FBE',
                                    '#0030BE','#003AE7',
                                ],
                                borderwidth:1
                            }]

                        },
                        options:{
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });

                }
                else{
                }
            }
        });
    
    $.ajax({
            url:  base_url + 'megasalud/StatisticsController/getLugar',
            type:  'get',
            success: function(respuesta){

                if(respuesta){
                    var res = JSON.parse(respuesta);
                    
                    var cLugar = document.getElementById("chartLugar");
                     var chartL = new Chart(cLugar,{
                       type: "bar",
                        data:{
                            labels: ["Aguascalientes","Baja California","Baja California Sur","Campeche","Chiapas","Chihuahua","Coahuila","Colima","D.F.","Durango","Guanajuato","Guerrero","Hidalgo","Jalisco","Michoacán","Mexico","Morelos","Nayarit","Nuevo Leon","Oaxaca","Puebla","Queretaro","San Luis Potosí","Sinaloa","Sonora","Tabasco","Tamaulipas","Tlaxcala","Veracruz","Yucatán","Zacatecas"],
                            datasets:[{
                                label: "# pacientes",
                                data: [res.aguas,res.bc,res.bcs,res.camp,res.chia,res.chihu,res.coahu,res.col,res.df,res.dur,res.guana,res.gue,res.hida,res.jal,res.mich,res.mex,res.mor,res.nay,res.nl,res.oax,res.pueb,res.que,res.slp,res.sin,res.son,res.tab,res.tama,res.tlax,res.vera,res.yuca,res.zaca],
                                backgroundColor:[
                                    '#00FFEA','#00FFEA',
                                    '#00FFEA','#00FFEA',
                                    '#00FFEA','#00FFEA',
                                    '#56D72C','#79E45E',
                                    '#2CD78B','#2CD7B9',
                                    '#2CC4D7','#79E45E',
                                    '#2C8BD7','#2C61D7',
                                    '#B8E45E','#702CD7',
                                    '#9F2CD7','#79E45E',
                                    '#D72CB8','#D72C89',
                                    '#79E45E','#D7812C',
                                    '#D7B82C','#79E45E',
                                    '#A6D72C','#00FFEA',
                                    '#00FFEA','#00FFEA',
                                    '#00FFEA','#00FFEA','#00FFEA',
                                ],
                                borderwidth:1
                            }]

                        },
                        options:{
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });

                }
                else{
                }
            }
        });
	 $.ajax({
            url:  base_url + 'megasalud/StatisticsController/getEntradaP',
            type:  'get',
            success: function(respuesta){

                if(respuesta){
                    var res = JSON.parse(respuesta);
                 var cEntraP = document.getElementById("chartEntraP");
                     var chartS = new Chart(cEntraP,{
                       type: "line",
                        data:{
                            labels: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                            datasets:[{
                                label: "# Pacientes",
                                data: [res.ene,res.feb,res.mar,res.abr,res.may,res.jun,res.jul,res.ago,res.sep,res.oct,res.nov,res.dic],
                                borderColor:[
                                    '#2C61D7'
                                ],
                                borderwidth:1,
                                lineTension:0
                            }]

                        },
                        options:{
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });

                }
                else{
                }
            }
        });
    
    $.ajax({
            url:  base_url + 'megasalud/StatisticsController/getPacientesFrom',
            type:  'get',
            success: function(respuesta){

                if(respuesta){
                    var res = JSON.parse(respuesta);
                 var cPFrom = document.getElementById("chartPFrom");
                     var chartS = new Chart(cPFrom,{
                       type: "line",
                        data:{
                            labels: ["Representantes","Recomendación","Clinica","Redes Sociales","Doctores"],
                            datasets:[{
                                label: "# Pacientes",
                                data: [res.agent,res.paciente,res.clinica,res.social,res.dr],
                                borderColor:[
                                    '#2CCBD7'
                                ],
                                borderwidth:1,
                                lineTension:0
                            }]

                        },
                        options:{
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });

                }
                else{
                }
            }
        }); 
    
                 var cPFrom = document.getElementById("chartP");
                     var chartS = new Chart(cPFrom,{
                       type: "line",
                        data:{
                            labels: ["2019-05-08","2019-06-08","2019-07-15","2019-07-22","2019-07-24","2019-10-16","2019-11-20","2020-01-13","2020-04-03","2020-05-03","2020-05-07","2020-06-08","2020-09-07","2020-10-09"],
                            datasets:[{
                                label: "Eritros",
                                data: [2.2,1.6,2.2,2.02,2.2,1.5,2.3,2.5,2.3,1.5,1.26,1.63,1.71,1.91],
                                borderColor:[
                                    '#2CCBD7'
                                ],
                                borderwidth:1,
                                lineTension:0
                            },{
                                label:"HGB",
                                data:[7.1,5.6,8.2,7.5,7.3,4.9,7.6,8.4,8.1,5.8,4.8,5.7,6.9,0.8],
                                 borderColor:[
                                    '#FF5733'
                                ],
                            },{
                                label:"Leucos",
                                data:[1.7,1.5,1.4,1.5,1.2,1.4,1.5,1.9,1.4,1.4,5.7,1.6,0.8,1.7],
                                 borderColor:[
                                    '#FFDB33'
                                ],
                            },{
                                label:"Plaquetas",
                                data:[11.0,13.0,10,25,9,8,9,11,10,11,4,9,16,7],
                                 borderColor:[
                                    '#9AFF33'
                                ],
                            }]

                        },
                        options:{
                            scales:{
                                yAxes:[{
                                    ticks:{
                                        beginAtZero:true
                                    }
                                }]
                            }
                        }
                    });

    
   



}
