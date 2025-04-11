# Consumindo a API do IBGE com PHP

Este é um projeto de exemplo para demonstrar como consumir a API pública do IBGE (Instituto Brasileiro de Geografia e Estatística) usando PHP.

## Arquivos do projeto

1. `index.php` - Página principal com a interface do usuário
2. `funcoes.php` - Biblioteca de funções para consumo da API
3. `estilo.css` - Folha de estilos da aplicação
4. `exemplo-api-sem-interface.php` - Versão simplificada sem interface gráfica

## Funcionalidades

O exemplo permite:

- Listar todos os estados brasileiros
- Buscar municípios de um estado específico
- Obter detalhes de um município específico
- Demonstrar como acessar dados populacionais

## Requisitos

- PHP 7.0 ou superior
- Extensão cURL habilitada
- Servidor web (Apache, Nginx, etc.)

## Como usar

1. Baixe ou clone este repositório
2. Coloque os arquivos em seu servidor web
3. Acesse `index.php` pelo navegador

## Sobre a API do IBGE

A API de serviço de dados do IBGE é gratuita e não requer autenticação. Ela oferece diversos endpoints com informações geográficas e estatísticas sobre o Brasil.

### Principais endpoints utilizados

- `/localidades/estados` - Lista todos os estados brasileiros
- `/localidades/estados/{UF}/municipios` - Lista municípios de um estado específico
- `/localidades/municipios/{id}` - Obtém informações detalhadas de um município

### Documentação oficial

Para mais informações, consulte a [documentação oficial da API](https://servicodados.ibge.gov.br/api/docs/).

## Uso em sala de aula

Este projeto foi desenvolvido como material educacional para ensinar:

1. Conceitos básicos de APIs
2. Como fazer requisições HTTP com PHP
3. Como processar respostas JSON
4. Como construir interfaces simples para demonstração

Os professores podem usar este material livremente, adaptando-o conforme necessário para suas aulas.

## Próximos passos

Algumas sugestões para expandir este exemplo:

- Adicionar paginação para listas longas
- Implementar busca por nome de município
- Criar visualizações com gráficos dos dados estatísticos
- Combinar dados de diferentes endpoints