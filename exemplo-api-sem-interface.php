<?php
/**
 * Exemplo simples de consumo da API do IBGE sem interface gráfica
 * Este exemplo demonstra apenas o consumo da API, exibindo os resultados diretamente
 */

// Função para fazer requisições à API
function fazerRequisicaoAPI($url) {
    $curl = curl_init();
    
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Accept: application/json"
        ],
    ]);
    
    $resposta = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    if ($err) {
        echo "Erro na requisição cURL: " . $err;
        return false;
    }
    
    return json_decode($resposta, true);
}

// Demonstração do consumo da API sem interface gráfica
echo "<h1>API do IBGE - Exemplo Simples</h1>";

// 1. Buscando todos os estados
echo "<h2>Estados do Brasil</h2>";
$url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";
$estados = fazerRequisicaoAPI($url);

if ($estados) {
    // Ordenando os estados por nome
    usort($estados, function($a, $b) {
        return strcmp($a['nome'], $b['nome']);
    });
    
    // Exibindo os primeiros 5 estados
    echo "<strong>Primeiros 5 estados:</strong><br>";
    for ($i = 0; $i < 5; $i++) {
        echo "{$estados[$i]['nome']} ({$estados[$i]['sigla']}) - ID: {$estados[$i]['id']}<br>";
    }
    
    // Total de estados
    echo "<br>Total de estados encontrados: " . count($estados) . "<br><br>";
} else {
    echo "Falha ao buscar estados.<br><br>";
}

// 2. Buscando municípios de São Paulo
echo "<h2>Municípios de São Paulo (SP)</h2>";
$url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/SP/municipios";
$municipios = fazerRequisicaoAPI($url);

if ($municipios) {
    // Exibindo os primeiros 5 municípios
    echo "<strong>Primeiros 5 municípios:</strong><br>";
    for ($i = 0; $i < 5; $i++) {
        echo "{$municipios[$i]['nome']} - ID: {$municipios[$i]['id']}<br>";
    }
    
    // Total de municípios
    echo "<br>Total de municípios em SP: " . count($municipios) . "<br><br>";
} else {
    echo "Falha ao buscar municípios.<br><br>";
}

// 3. Buscando detalhes do município de São Paulo capital
echo "<h2>Detalhes de São Paulo (capital)</h2>";
$url = "https://servicodados.ibge.gov.br/api/v1/localidades/municipios/3550308";
$municipio = fazerRequisicaoAPI($url);

if ($municipio) {
    echo "<strong>Nome:</strong> {$municipio['nome']}<br>";
    echo "<strong>ID:</strong> {$municipio['id']}<br>";
    echo "<strong>Estado:</strong> {$municipio['microrregiao']['mesorregiao']['UF']['nome']} ({$municipio['microrregiao']['mesorregiao']['UF']['sigla']})<br>";
    echo "<strong>Microrregião:</strong> {$municipio['microrregiao']['nome']}<br>";
    echo "<strong>Mesorregião:</strong> {$municipio['microrregiao']['mesorregiao']['nome']}<br>";
    echo "<strong>Região:</strong> {$municipio['microrregiao']['mesorregiao']['UF']['regiao']['nome']}<br><br>";
} else {
    echo "Falha ao buscar detalhes do município.<br><br>";
}

// 4. Exemplo de como você poderia obter informações com outro endpoint
echo "<h2>Exemplo de outros dados disponíveis</h2>";
echo "A API do IBGE oferece diversos endpoints além dos mostrados acima:<br>";
echo "- Malhas territoriais<br>";
echo "- Dados agregados (informações estatísticas)<br>";
echo "- Nomes (estatísticas sobre nomes de pessoas no Brasil)<br>";
echo "- CNAE (Classificação Nacional de Atividades Econômicas)<br>";
echo "- Produtos (classificação de produtos e serviços)<br><br>";

echo "Para mais informações, consulte a documentação oficial: ";
echo "<a href='https://servicodados.ibge.gov.br/api/docs/' target='_blank'>https://servicodados.ibge.gov.br/api/docs/</a>";
?>