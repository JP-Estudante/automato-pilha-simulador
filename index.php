<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de Autômato de Pilha</title>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <link rel="stylesheet" href="styles.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Oculta a <div> inicialmente
            document.getElementById('output').style.display = 'none';
        });

        async function enviarCadeia(action) {
            const entrada = document.getElementById('entrada').value;
            if (entrada.trim() === '') {
                alert('Digite uma cadeia.');
                return;
            }

            let response;
            if (action === 'Iniciar') {
                document.getElementById('passos').disabled = false;
                document.getElementById('iniciar').disabled = true;

                // Enviar a cadeia para o servidor
                response = await fetch('verificador.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        entrada: entrada
                    })
                });

                // Exibir o texto fora da <div id="output">
                document.getElementById('inicio').innerHTML = `Iniciando a verificação da cadeia: ${entrada}`;

                // Mostrar a <div> e definir o conteúdo inicial com a classe pixel-font
                document.getElementById('output').style.display = 'block';
                document.getElementById('output').innerHTML = `<p class="pixel-font">${await response.text()}</p>`;
            } else if (action === 'Passos') {
                response = await fetch('verificador.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        proximo: '1'
                    })
                });

                // Adicionar o próximo passo à <div> com a classe pixel-font
                document.getElementById('output').innerHTML += `<p class="pixel-font">${await response.text()}</p>`;
            }

            // Força o MathJax a processar o novo conteúdo
            MathJax.typeset();
        }

        function limparSaida() {
            document.getElementById('output').innerHTML = ''; // Limpa a saída
            document.getElementById('inicio').innerHTML = ''; // Limpa o texto inicial
            document.getElementById('passos').disabled = true; // Desativa o botão "Passos"
            document.getElementById('iniciar').disabled = false; // Reativa o botão "Iniciar"
        }
    </script>
</head>

<body>
    <h1>Verificador de Autômato de Pilha</h1>

    <form>
        <label for="entrada">Digite a cadeia (formato \( a^{(n-1)} b^n \), com \( n > 0 \)):</label><br>
        <input type="text" id="entrada" name="entrada">

        <div class="input-group">
            <input type="button" id="iniciar" value="Iniciar" onclick="enviarCadeia('Iniciar')">
            <input type="button" id="passos" value="Passos" onclick="enviarCadeia('Passos')" disabled>
            <input type="button" id="limpar" value="Limpar" onclick="limparSaida()"> <!-- Novo botão -->
        </div>
    </form>

    <!-- Elemento para mostrar o texto "Iniciando a verificação da cadeia: " -->
    <div id="inicio"></div>

    <!-- Div para mostrar os passos -->
    <div id="output" class="output"></div>
</body>

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    width="357pt" height="92pt" viewBox="0.00 0.00 356.75 92.19">
    <g id="graph0" class="graph" transform="scale(1 1) rotate(0) translate(4 88.1869)">
        <title>PDA</title>
        <polygon fill="none" stroke="transparent" points="-4,4 -4,-88.1869 352.7504,-88.1869 352.7504,4 -4,4" />
        <!-- start -->
        <g id="node1" class="node">
            <title>start</title>
            <ellipse fill="#000000" stroke="#000000" cx="1.8" cy="-24.6935" rx="1.8" ry="1.8" />
        </g>
        <!-- q0 -->
        <g id="node3" class="node">
            <title>q0</title>
            <ellipse fill="none" stroke="#000000" cx="61.2935" cy="-24.6935" rx="20.8887" ry="20.8887" />
            <text text-anchor="middle" x="61.2935" y="-20.4935" font-family="Times,serif" font-size="14.00"
                fill="#000000">q0</text>
        </g>
        <!-- start&#45;&gt;q0 -->
        <g id="edge1" class="edge">
            <title>start-&gt;q0</title>
            <path fill="none" stroke="#000000" d="M3.7795,-24.6935C8.1326,-24.6935 19.0417,-24.6935 30.2036,-24.6935" />
            <polygon fill="#000000" stroke="#000000"
                points="30.3445,-28.1936 40.3444,-24.6935 30.3444,-21.1936 30.3445,-28.1936" />
        </g>
        <!-- q2 -->
        <g id="node2" class="node">
            <title>q2</title>
            <ellipse fill="none" stroke="#000000" cx="322.4675" cy="-24.6935" rx="20.8568" ry="20.8568" />
            <ellipse fill="none" stroke="#000000" cx="322.4675" cy="-24.6935" rx="24.8884" ry="24.8884" />
            <text text-anchor="middle" x="322.4675" y="-20.4935" font-family="Times,serif" font-size="14.00"
                fill="#000000">q2</text>
        </g>
        <!-- q2&#45;&gt;q2 -->
        <g id="edge5" class="edge">
            <title>q2-&gt;q2</title>
            <path fill="none" stroke="#000000"
                d="M310.1657,-46.2213C308.2731,-57.3528 312.3737,-67.3869 322.4675,-67.3869 329.2492,-67.3869 333.3255,-62.8574 334.6964,-56.5087" />
            <polygon fill="#000000" stroke="#000000"
                points="338.1983,-56.2458 334.7692,-46.2213 331.1985,-56.1962 338.1983,-56.2458" />
            <text text-anchor="middle" x="322.4675" y="-71.5869" font-family="Times,serif" font-size="14.00"
                fill="#000000">b | X → ε</text>
        </g>
        <!-- q1 -->
        <g id="node4" class="node">
            <title>q1</title>
            <ellipse fill="none" stroke="#000000" cx="190.4608" cy="-24.6935" rx="20.8887" ry="20.8887" />
            <text text-anchor="middle" x="190.4608" y="-20.4935" font-family="Times,serif" font-size="14.00"
                fill="#000000">q1</text>
        </g>
        <!-- q0&#45;&gt;q1 -->
        <g id="edge2" class="edge">
            <title>q0-&gt;q1</title>
            <path fill="none" stroke="#000000"
                d="M82.0464,-24.6935C103.0433,-24.6935 135.743,-24.6935 159.7425,-24.6935" />
            <polygon fill="#000000" stroke="#000000"
                points="159.7593,-28.1936 169.7593,-24.6935 159.7593,-21.1936 159.7593,-28.1936" />
            <text text-anchor="middle" x="121.7931" y="-29.1935" font-family="Times,serif" font-size="14.00"
                fill="#000000">a | ε → X</text>
        </g>
        <!-- q1&#45;&gt;q2 -->
        <g id="edge4" class="edge">
            <title>q1-&gt;q2</title>
            <path fill="none" stroke="#000000"
                d="M211.4213,-24.6935C239.2666,-24.6935 286.7417,-24.6935 310.2004,-24.6935" />
            <polygon fill="#000000" stroke="#000000"
                points="310.197,-21.1936 310.197,-28.1936 320.197,-24.6935 310.197,-21.1936" />
            <text text-anchor="middle" x="261.3444" y="-29.1935" font-family="Times,serif" font-size="14.00"
                fill="#000000">b | X → ε</text>
        </g>
    </g>
</svg>

</html>
