
$("#btn_iniciar_cuestionario").on('click', function () {


    console.log($("#id_paciente").val());

    $.ajax({
        url: base_url + 'megasalud/QuizController/getQuestions?paciente_id=' + $("#id_paciente").val(),
        type: 'get',
        success: function (resp) {
            if (resp) {

                var res = JSON.parse(resp);

                $("#name_empleo").html(res.empleo);

                console.log(res);
                console.log(res.empleo);
                console.log(res.general_questions.concat(res.data));

            }
        }
    });

});