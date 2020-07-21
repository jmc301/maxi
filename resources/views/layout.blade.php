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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        img.pdf{
            transition: all 0.5s;
            cursor: pointer;        }

        img.pdf:hover{
            -webkit-transform: scale(1.5);
            transform: scale(1.5);
        }
    </style>        
</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between"> -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- <a class="navbar-brand" href="/menu"><img src="http://localhost:8000/logo.png" class="mr-2">Home</a> -->
        <a class="navbar-brand" href="/menu">Home</a>
        <a class="navbar-brand" href="{{route('listar_pedidos')}}">Pedidos</a>
        <!-- <a class="navbar-brand" href="{{route('listar_representantes')}}">Vendedores</a> -->
        <!-- <a class="navbar-brand" href="{{route('listar_clientes')}}">Clientes</a> -->
        <a class="navbar-brand" href="{{route('listar_titulos')}}">T&iacute;tulos</a>

        <!-- Links -->
        <ul class="navbar-nav ">
            <!-- Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle navbar-brand" href="#" id="navbardrop" data-toggle="dropdown">
                Cadastros
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('listar_clientes')}}"><strong>Clientes</strong></a>
                <a class="dropdown-item" href="{{route('produto')}}"><strong>Produtos</strong></a>
                <a class="dropdown-item" href="{{route('listar_representantes')}}"><strong>Vendedores</strong></a>
                <a class="dropdown-item" href="{{route('listar_condpagamentos')}}"><strong>Condição de Pagamento</strong></a>
              </div>
            </li>
        </ul>

        @auth()
        <a href="/sair" class="text-danger">Sair</a>  
        @endauth()
<!--  
     <div class="col-8"></div>
     <div class="col-1">
     	<a href="https://www.sintegra.gov.br/" target="_blank">
     	   <img border="1" alt="Sintegra - Consulta CNPJ" src="https://www.sintegra.gov.br/figuras/logo.gif" width="50" height="50">
     	</a>
     </div>
-->     
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

        $("#cnpjcpf").keydown(function() {
            try {
                $("#cnpjcpf").unmask();
            } catch (e) {}

            var tamanho = $("#cnpjcpf").val().length;

            if (tamanho < 11) {
                $("#cpfcnpj").mask("999.999.999-99");
            } else if (tamanho >= 11) {
                $("#cnpjcpf").mask("99.999.999/9999-99");
            }

            // ajustando foco
            var elem = this;
            setTimeout(function() {
                // mudo a posição do seletor
                elem.selectionStart = elem.selectionEnd = 10000;
            }, 0);
            // reaplico o valor para mudar o foco
            var currentValue = $(this).val();
            $(this).val('');
            $(this).val(currentValue);
        });        
    </script>

</body>
</html>
