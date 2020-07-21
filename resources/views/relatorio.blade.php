<!doctype html>
<html lang="pts-BR">
<head>    
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div>
        <div >
            <h2>@yield('cabecalho')</h2>
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
