<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema Alura Cursos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
        <!-- <a class="navbar-brand" href="/menu"><img src="http://localhost:8000/logo.png" class="mr-2">Home</a> -->
        <a class="navbar-brand" href="/menu">Home</a>
        <a class="navbar-brand" href="{{route('listar_representantes')}}">Vendedores</a>
        <a class="navbar-brand" href="{{route('listar_clientes')}}">Clientes</a>
        <a class="navbar-brand" href="{{route('listar_titulos')}}">T&iacute;tulos</a>
        <a href="/menu" class="text-danger">Sair</a>        
    </nav>
         
    <div class="container">
        <div class="jumbotron">
            <h1>@yield('cabecalho')</h1>
        </div>

        @yield('conteudo')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.easing.1.3.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>
        $("#cep").mask("##.###-###");

        $("#cep").blur(function() {
            var cep = $(this).val().replace(/\D/g, '');
            if (cep != "") {
                var validacep = /^[0-9]{8}$/;
                $("#endereco").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(data) {
                    if (!("erro" in data)) {
                        $("#endereco").val(data.logradouro);
                        $("#bairro").val(data.bairro);
                        $("#uf").val(data.uf);
                        $("#cidade").val(data.localidade);
                        $("#numero").focus();
                    } else {
                        alert("CEP não encontrado.");
                    }
                });
            }
        });
    </script>

</body>
</html>
