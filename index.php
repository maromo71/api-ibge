<?php
// Inclui o arquivo de funções
require_once 'funcoes.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo da API do IBGE com PHP</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Consumo da API do IBGE com PHP</h1>
    <p>Exemplo de aplicação que consome dados da API pública do IBGE.</p>
    
    <div class="container">
        <h2>1. Lista de Estados</h2>
        <form method="post">
            <button type="submit" name="listar_estados">Listar Todos os Estados</button>
        </form>
        
        <?php
        if (isset($_POST['listar_estados'])) {
            echo '<div class="resultado">';
            $estados = listarEstados();
            echo '</div>';
        }
        ?>
    </div>
    
    <div class="container">
        <h2>2. Municípios por Estado</h2>
        <form method="post">
            <label for="uf">Selecione um estado (UF):</label>
            <select name="uf" id="uf">
                <option value="SP">São Paulo</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="MG">Minas Gerais</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="BA">Bahia</option>
                <option value="PR">Paraná</option>
                <option value="SC">Santa Catarina</option>
                <!-- Adicione mais estados conforme necessário -->
            </select>
            <button type="submit" name="listar_municipios">Buscar Municípios</button>
        </form>
        
        <?php
        if (isset($_POST['listar_municipios']) && isset($_POST['uf'])) {
            echo '<div class="resultado">';
            listarMunicipiosPorEstado($_POST['uf']);
            echo '</div>';
        }
        ?>
    </div>
    
    <div class="container">
        <h2>3. Detalhes de um Município</h2>
        <form method="post">
            <label for="id_municipio">ID do Município:</label>
            <input type="number" name="id_municipio" id="id_municipio" placeholder="Ex: 3550308 (São Paulo)" required>
            <button type="submit" name="detalhar_municipio">Buscar Detalhes</button>
        </form>
        
        <?php
        if (isset($_POST['detalhar_municipio']) && isset($_POST['id_municipio'])) {
            echo '<div class="resultado">';
            obterDetalhesMunicipio($_POST['id_municipio']);
            echo '</div>';
        }
        ?>
    </div>
    
    <div class="container">
        <h2>4. Dados Populacionais</h2>
        <form method="post">
            <label for="uf_populacao">Selecione um estado (UF):</label>
            <select name="uf_populacao" id="uf_populacao">
                <option value="SP">São Paulo</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="MG">Minas Gerais</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="BA">Bahia</option>
                <!-- Adicione mais estados conforme necessário -->
            </select>
            <button type="submit" name="dados_populacionais">Buscar Dados Populacionais</button>
        </form>
        
        <?php
        if (isset($_POST['dados_populacionais']) && isset($_POST['uf_populacao'])) {
            echo '<div class="resultado">';
            obterDadosPopulacionais($_POST['uf_populacao']);
            echo '</div>';
        }
        ?>
    </div>
    
    <footer>
        <p><small>Dados fornecidos pela API do IBGE: <a href="https://servicodados.ibge.gov.br/api/docs/" target="_blank">https://servicodados.ibge.gov.br/api/docs/</a></small></p>
    </footer>
</body>
</html>