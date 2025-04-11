<?php
/**
 * Funções para consumo da API do IBGE
 * API utilizada: Serviço de Dados do IBGE (https://servicodados.ibge.gov.br/api/docs/)
 */

// Função para fazer requisições à API
function fazerRequisicaoAPI($url) {
    // Inicializa o cURL
    $curl = curl_init();
    
    // Configura as opções do cURL
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
    
    // Executa a requisição e obtém a resposta
    $resposta = curl_exec($curl);
    $err = curl_error($curl);
    
    // Fecha a conexão cURL
    curl_close($curl);
    
    // Verifica se houve erro
    if ($err) {
        echo "Erro na requisição cURL: " . $err;
        return false;
    }
    
    // Decodifica o JSON para um array associativo
    return json_decode($resposta, true);
}

// 1. Listar todos os estados brasileiros
function listarEstados() {
    $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";
    $estados = fazerRequisicaoAPI($url);
    
    if (!$estados) {
        echo "<p>Não foi possível obter a lista de estados.</p>";
        return;
    }
    
    // Ordena os estados por nome
    usort($estados, function($a, $b) {
        return strcmp($a['nome'], $b['nome']);
    });
    
    echo "<h2>Estados do Brasil</h2>";
    echo "<ul>";
    foreach ($estados as $estado) {
        echo "<li>{$estado['nome']} ({$estado['sigla']}) - ID: {$estado['id']}</li>";
    }
    echo "</ul>";
    
    return $estados;
}

// 2. Listar municípios de um estado específico
function listarMunicipiosPorEstado($uf) {
    $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios";
    $municipios = fazerRequisicaoAPI($url);
    
    if (!$municipios) {
        echo "<p>Não foi possível obter a lista de municípios para a UF: {$uf}.</p>";
        return;
    }
    
    echo "<h2>Municípios de {$uf}</h2>";
    echo "<p>Total de municípios: " . count($municipios) . "</p>";
    echo "<ul>";
    foreach ($municipios as $municipio) {
        echo "<li>{$municipio['nome']} - ID: {$municipio['id']}</li>";
    }
    echo "</ul>";
}

// 3. Obter informações detalhadas de um município específico
function obterDetalhesMunicipio($idMunicipio) {
    $url = "https://servicodados.ibge.gov.br/api/v1/localidades/municipios/{$idMunicipio}";
    $municipio = fazerRequisicaoAPI($url);
    
    if (!$municipio) {
        echo "<p>Não foi possível obter informações do município com ID: {$idMunicipio}.</p>";
        return;
    }
    
    echo "<h2>Detalhes do Município</h2>";
    echo "<p><strong>Nome:</strong> {$municipio['nome']}</p>";
    echo "<p><strong>ID:</strong> {$municipio['id']}</p>";
    echo "<p><strong>Estado:</strong> {$municipio['microrregiao']['mesorregiao']['UF']['nome']} ({$municipio['microrregiao']['mesorregiao']['UF']['sigla']})</p>";
    echo "<p><strong>Microrregião:</strong> {$municipio['microrregiao']['nome']}</p>";
    echo "<p><strong>Mesorregião:</strong> {$municipio['microrregiao']['mesorregiao']['nome']}</p>";
    echo "<p><strong>Região:</strong> {$municipio['microrregiao']['mesorregiao']['UF']['regiao']['nome']}</p>";
}

// 4. Buscar dados estatísticos populacionais por UF
function obterDadosPopulacionais($uf) {
    // Não há endpoint direto para dados populacionais na API aberta
    // Em uma aplicação real, você poderia combinar com dados do censo ou outra fonte
    echo "<h2>Dados Populacionais</h2>";
    echo "<p>Para obter dados populacionais completos, você precisaria usar a API de dados estatísticos:</p>";
    echo "<p>Acesse: <a href='https://servicodados.ibge.gov.br/api/docs/agregados' target='_blank'>API de Agregados do IBGE</a></p>";
}
?>